<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LostFoundController extends Controller
{
    public function lost_found(Request $request)
    {
        return $this->filterLostFounds($request);
    }

       public function store_lost(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'object_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'object_type' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
            'first_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
            'middle_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:1',
            'last_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
            'course' => 'nullable|regex:/^[A-Za-z\s]+$/|max:50',
            'location' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'remarks' => 'nullable|string|max:255',
        ],
        [
            'object_img.image' => 'The object image must be an image file.',
            'object_img.mimes' => 'Allowed image types: jpeg, png, jpg, gif, svg.',
            'object_img.max' => 'Image size cannot exceed 2MB.',
            'object_type.required' => 'Object type is required.',
            'object_type.regex' => 'Object type should contain only letters and spaces.',
            'object_type.max' => 'Object type cannot exceed 255 characters.',
            'first_name.required' => 'First name is required.',
            'first_name.regex' => 'First name should contain only letters and spaces.',
            'first_name.max' => 'First name cannot exceed 50 characters.',
            'middle_name.regex' => 'Middle initial should contain only one letter.',
            'middle_name.max' => 'Middle initial should be one letter.',
            'last_name.required' => 'Last name is required.',
            'last_name.regex' => 'Last name should contain only letters and spaces.',
            'last_name.max' => 'Last name cannot exceed 50 characters.',
            'course.regex' => 'Course should contain only letters and spaces.',
            'course.max' => 'Course cannot exceed 50 characters.',
            'location.required' => 'Location is required.',
            'description.max' => 'Description cannot exceed 1000 characters.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $data = [
            'user_id' => Auth::id(),
            'object_type' => $request->object_type,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'course' => $request->course,
            'location' => $request->location,
            'description' => $request->description,
            'is_claimed' => 0,
            'is_transferred' => 0,
            'remarks' => $request->remarks ?? null,
        ];
        if ($request->hasFile('object_img')) {
            $fileName = time() . '_' . $request->file('object_img')->getClientOriginalName();
            $path = $request->file('object_img')->storeAs('lost_images', $fileName, 'public');
            $data['object_img'] = '/storage/' . $path;
        }

        $lost = Lost::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $lost
        ]);


    }

    public function updateLostFound(Request $request, string $id)
    {
        $lost_found = Lost::findOrFail($id);

        $validatedData = Validator::make($request->all(),[
            'object_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'object_type' => 'required|string|max:255',
            'first_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
            'middle_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:1',
            'last_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
            'course' => 'nullable|regex:/^[A-Za-z\s]+$/|max:50',
            'location' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'remarks' => 'nullable|string|max:255',
        ],
        [
            'object_img.image' => 'The object image must be an image file.',
            'object_img.mimes' => 'Allowed image types: jpeg, png, jpg, gif, svg.',
            'object_img.max' => 'Image size cannot exceed 2MB.',
            'object_type.required' => 'Object type is required.',
            'object_type.max' => 'Object type cannot exceed 255 characters.',
            'first_name.required' => 'First name is required.',
            'first_name.regex' => 'First name should contain only letters and spaces.',
            'first_name.max' => 'First name cannot exceed 50 characters.',
            'middle_name.regex' => 'Middle initial should contain only one letter.',
            'middle_name.max' => 'Middle initial should be one letter.',
            'last_name.required' => 'Last name is required.',
            'last_name.regex' => 'Last name should contain only letters and spaces.',
            'last_name.max' => 'Last name cannot exceed 50 characters.',
            'course.regex' => 'Course should contain only letters and spaces.',
            'course.max' => 'Course cannot exceed 50 characters.',
            'location.required' => 'Location is required.',
            'description.max' => 'Description cannot exceed 1000 characters.',
            'remarks.max' => 'Remarks cannot exceed 255 characters.',
            ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        if ($request->hasFile('object_img')) {
            if ($lost_found->object_img && file_exists(public_path($lost_found->object_img))) {
                unlink(public_path($lost_found->object_img));
            }

            $fileName = time() . '_' . $request->file('object_img')->getClientOriginalName();
            $path = $request->file('object_img')->storeAs('lost_images', $fileName, 'public');
            $lost_found->object_img = '/storage/' . $path;
        }

        $lost_found->update($request->all());


        return response()->json([
            'success' => true,
            'lost_found' => $lost_found,
        ]);
    }


    public function filterLostFounds(Request $request)
    {
        if ($request->filled('start_date') || $request->filled('end_date')) {
            session(['lost_found_filter' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]]);
        }

        $query = Lost::query();
        $user = Auth::user();

        $filterData = session('lost_found_filter', [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if (!empty($filterData['start_date'])) {
            $query->whereDate('created_at', '>=', $filterData['start_date']);
        }

        if (!empty($filterData['end_date'])) {
            $query->whereDate('created_at', '<=', $filterData['end_date']);
        }


        $lost_found = $query->orderBy('created_at', 'desc')->get();

        return view('sub-admin.lost.lost_found', compact('lost_found', 'request', 'user'));
    }

    public function clearFilter()
    {
        session()->forget('lost_found_filter');
        return redirect()->route('sub-admin.lost.lost_found');
    }

    public function updateClaimed(Request $request, $id)
    {
        $lostItem = Lost::find($id);

        if ($lostItem) {
            // Check if an image is uploaded
            if ($request->hasFile('proof_image')) {
                $fileName = time() . '_' . $request->file('proof_image')->getClientOriginalName();
                $path = $request->file('proof_image')->storeAs('proof_claimed', $fileName, 'public');
                $lostItem['proof_image'] = '/storage/' . $path;
            }

            // Update the claim status
            $lostItem->security_staff = Auth::user()->id;
            $lostItem->is_claimed = 1;
            $lostItem->save();

            return response()->json(['success' => true, 'message' => 'Item marked as claimed']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found'], 404);
    }


public function updateTransfer(Request $request, $id)
{
    $lostItem = Lost::find($id);

    if ($lostItem) {
        $lostItem->is_transferred = $request->is_transferred;
        $lostItem->save();

        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false], 404);
    }
}


public function lost_found_admin(Request $request)
        {
            return $this->filterLostFoundAdmin($request);
        }

        public function destroy_lostFound(string $id)
        {
            $lost_found = Lost::findOrFail($id);

            $lost_found->delete();

            return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
        }

        public function filterLostFoundAdmin(Request $request)
    {
        if ($request->filled('start_date') || $request->filled('end_date')) {
            session(['lost_found_admin_filter' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]]);
        }

        $query = Lost::query();
        $user = Auth::user();

        $filterData = session('lost_found_admin_filter', [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if (!empty($filterData['start_date'])) {
            $query->whereDate('created_at', '>=', $filterData['start_date']);
        }

        if (!empty($filterData['end_date'])) {
            $query->whereDate('created_at', '<=', $filterData['end_date']);
        }

        $lost_found = $query->orderBy('created_at', 'desc')->get();

        return view('admin.lost.lost_found_admin', compact('lost_found', 'request', 'user'));
    }

    public function clearFilterAdmin()
    {
        session()->forget('lost_found_admin_filter');
        return redirect()->route('admin.lost.lost_found_admin');
    }
}
