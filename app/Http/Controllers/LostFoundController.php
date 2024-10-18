<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LostFoundController extends Controller
{
    public function lost_found(Request $request)
    {
        return $this->filterLostFounds($request);
    }

       public function store_lost(Request $request)
    {
        $request->validate([
            'object_type' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'object_img' => 'nullable|image|max:3048',
            'location' => 'required|string|max:255',
            'is_claimed' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'object_type' => $request->object_type,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'course' => $request->course,
            'location' => $request->location,
            'security_staff' => Auth::user()->name,
            'is_claimed' => $request->is_claimed,
            'description' => $request->description,
        ];

        if ($request->hasFile('object_img')) {
            $fileName = time() . '_' . $request->file('object_img')->getClientOriginalName();
            $path = $request->file('object_img')->storeAs('lost_images', $fileName, 'public');
            $data['object_img'] = '/storage/' . $path;
        }

        Lost::create($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updateClaimedSub(Request $request, $id)
    {
        $lostItem = Lost::find($id);

        if ($lostItem) {
            $lostItem->is_claimed = $request->is_claimed;
            $lostItem->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }


    public function updateLostFound(Request $request, string $id)
    {
        $lost_found = Lost::findOrFail($id);

        if ($request->hasFile('object_img')) {
            if ($lost_found->object_img && file_exists(public_path($lost_found->object_img))) {
                unlink(public_path($lost_found->object_img));
            }

            $fileName = time() . '_' . $request->file('object_img')->getClientOriginalName();
            $path = $request->file('object_img')->storeAs('lost_images', $fileName, 'public');
            $lost_found->object_img = '/storage/' . $path;
        }

        $lost_found->object_type = $request->input('object_type');
        $lost_found->first_name = $request->input('first_name');
        $lost_found->middle_name = $request->input('middle_name');
        $lost_found->last_name = $request->input('last_name');
        $lost_found->course = $request->input('course');

        $lost_found->save();

        return redirect()->route('sub-admin.lost.lost_found')->with('success', 'Lost and Found updated successfully');
    }

    public function filterLostFounds(Request $request)
    {
        $query = Lost::query();
        $user = Auth::user();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        $lost_found = $query->orderBy('created_at', 'desc')->get();

        return view('sub-admin.lost.lost_found', compact('lost_found', 'request', 'user'));
    }

    public function updateClaimed(Request $request, $id)
{
    $lostItem = Lost::find($id);

    if ($lostItem) {
        $lostItem->is_claimed = $request->is_claimed;
        $lostItem->save();

        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false], 404);
    }
}


        public function lost_found_admin()
        {
            $lost_found = Lost::latest()->get();
            return view('admin.lost.lost_found_admin', compact('lost_found'));
        }

       public function store_lost_admin(Request $request)
    {
        $request->validate([
            'object_type' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'object_img' => 'nullable|image|max:3048',
            'location' => 'required|string|max:255',
            'is_claimed' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'object_type' => $request->object_type,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'course' => $request->course,
            'location' => $request->location,
            'security_staff' => Auth::name()->name,
            'is_claimed' => $request->is_claimed,
            'description' => $request->description,
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

    public function updateLostFoundAdmin(Request $request, string $id)
    {
        $lost_found = Lost::findOrFail($id);

        // Check if a new file is uploaded and handle it
        if ($request->hasFile('object_img')) {
            // Delete the old image if it exists
            if ($lost_found->object_img && file_exists(public_path($lost_found->object_img))) {
                unlink(public_path($lost_found->object_img));
            }

            // Store the new image
            $fileName = time() . '_' . $request->file('object_img')->getClientOriginalName();
            $path = $request->file('object_img')->storeAs('lost_images', $fileName, 'public');
            $lost_found->object_img = '/storage/' . $path;
        }
        $lost_found->object_type = $request->input('object_type');
        $lost_found->first_name = $request->input('first_name');
        $lost_found->middle_name = $request->input('middle_name');
        $lost_found->last_name = $request->input('last_name');
        $lost_found->course = $request->input('course');
        $lost_found->location = $request->input('location');
        $lost_found->security_staff = $request->input('security_staff');
        $lost_found->is_claimed = $request->input('is_claimed');
        $lost_found->description = $request->input('description');

          // Save the updated model
          $lost_found->save();

          return redirect()->route('admin.lost.lost_found_admin')->with('success', 'Lost and Found updated successfully');
      }

        public function destroy_lostFound(string $id)
        {
            $lost_found = Lost::findOrFail($id);

            $lost_found->delete();

            return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
        }

        public function filterLostFoundAdmin(Request $request)
    {
        $query = Lost::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                  ->whereDate('created_at', '<=', $request->end_date);
        }

        $lost_found = $query->orderBy('created_at', 'desc')->get();

        return view('admin.lost_found_admin', compact('lost_found'));
    }
}
