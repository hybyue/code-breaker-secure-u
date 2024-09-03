<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lost;
use App\Models\PassSlip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GlobalController extends Controller
{
    public function pass_slip(Request $request)
{
    return $this->filterPassSlip($request);
}

public function filterPassSlip(Request $request)
{
    $query = PassSlip::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    if ($request->filled('employee_type')) {
        $query->where('employee_type', $request->employee_type);
    }

    // Fetch the latest pass slips per user for the specified date range
    $latestPassSlips = PassSlip::select('pass_slips.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date) as latest'), 'pass_slips.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $subQuery->whereDate('pass_slips.created_at', '>=', $request->start_date)
                         ->whereDate('pass_slips.created_at', '<=', $request->end_date);
            }
            if ($request->filled('employee_type')) {
                $subQuery->where('pass_slips.employee_type', $request->employee_type);
            }
        })
        ->orderBy('pass_slips.created_at', 'desc')
        ->paginate(10);

    // Fetch all pass slips for viewing older entries in modal
    $allPassSlips = $query->get();

    return view('sub-admin.pass_slip', compact('latestPassSlips', 'allPassSlips'));
}

    public function store_slip(Request $request)
    {
        $request->validate([
            'p_no' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'employee_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'date' => 'required|date',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'required|date_format:H:i',
        ]);

        PassSlip::create([
            'user_id' => Auth::id(),
            'p_no' => $request->p_no,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'department' => $request->department,
            'designation' => $request->designation,
            'destination' => $request->destination,
            'employee_type' => $request->employee_type,
            'purpose' => $request->purpose,
            'date' => $request->date,
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
        ]);

        return redirect()->route('sub-admin.pass_slip')->with('success', 'Pass Slip created successfully.');
    }

    public function updatePassSlip(Request $request, string $id)
{
    $passSlips = PassSlip::findOrFail($id);

    $passSlips->update($request->all());

    return redirect()->route('sub-admin.pass_slip')->with('success', 'Pass Slip updated successfully');
}





public function pass_slip_admin(Request $request)
{
    return $this->filterPassSlipAdmin($request);
}

public function filterPassSlipAdmin(Request $request)
{
    $query = PassSlip::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    if ($request->filled('employee_type')) {
        $query->where('employee_type', $request->employee_type);
    }

    // Fetch the latest pass slips per user for the specified date range
    $latestPassSlips = PassSlip::select('pass_slips.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date) as latest'), 'pass_slips.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $subQuery->whereDate('pass_slips.created_at', '>=', $request->start_date)
                         ->whereDate('pass_slips.created_at', '<=', $request->end_date);
            }
            if ($request->filled('employee_type')) {
                $subQuery->where('pass_slips.employee_type', $request->employee_type);
            }
        })
        ->orderBy('pass_slips.created_at', 'desc')
        ->paginate(10);

    // Fetch all pass slips for viewing older entries in modal
    $allPassSlips = $query->get();

    return view('admin.pass_slip.pass_slip_admin', compact('latestPassSlips', 'allPassSlips'));
}

    public function store_slip_admin(Request $request)
    {
        $request->validate([
            'p_no' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'employee_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'date' => 'required|date',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'required|date_format:H:i',
        ]);

        PassSlip::create([
            'user_id' => Auth::id(),
            'p_no' => $request->p_no,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'department' => $request->department,
            'designation' => $request->designation,
            'destination' => $request->destination,
            'employee_type' => $request->employee_type,
            'purpose' => $request->purpose,
            'date' => $request->date,
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updatePassSlipAdmin(Request $request, string $id)
    {
        $passSlips = PassSlip::findOrFail($id);

        $passSlips->update($request->all());

        return redirect()->route('admin.pass_slip.pass_slip_admin')->with('success', 'Pass Slip updated successfully');
    }


    public function destroy_passSlip(string $id)
    {
        $passSlips = PassSlip::findOrFail($id);

        $passSlips->delete();

        return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
    }



    public function lost_found()
{
    $lost_found = Lost::orderBy('created_at', 'desc')->paginate(10);
    return view('sub-admin.lost_found', compact('lost_found'));
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
    ]);

    $data = [
        'user_id' => Auth::id(),
        'object_type' => $request->object_type,
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'course' => $request->course,
    ];

    if ($request->hasFile('object_img')) {
        $fileName = time() . '_' . $request->file('object_img')->getClientOriginalName();
        $path = $request->file('object_img')->storeAs('lost_images', $fileName, 'public');
        $data['object_img'] = '/storage/' . $path;
    }

    Lost::create($data);

    return redirect()->route('sub-admin.lost_found')->with('success', 'Lost and found created successfully.');
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

    return redirect()->route('sub-admin.lost_found')->with('success', 'Lost and Found updated successfully');
}

public function filterLostFound(Request $request)
{
    $query = Lost::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    $lost_found = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('sub-admin.lost_found', compact('lost_found'));
}


    public function lost_found_admin()
    {
        $lost_found = Lost::all();
        return view('admin.lost_found_admin', compact('lost_found'));
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
    ]);

    $data = [
        'user_id' => Auth::id(),
        'object_type' => $request->object_type,
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'course' => $request->course,
    ];

    if ($request->hasFile('object_img')) {
        $fileName = time() . '_' . $request->file('object_img')->getClientOriginalName();
        $path = $request->file('object_img')->storeAs('lost_images', $fileName, 'public');
        $data['object_img'] = '/storage/' . $path;
    }

    Lost::create($data);

    return redirect()->route('admin.lost_found_admin')->with('success', 'Lost and found created successfully.');
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
      // Update other fields
      $lost_found->object_type = $request->input('object_type');
      $lost_found->first_name = $request->input('first_name');
      $lost_found->middle_name = $request->input('middle_name');
      $lost_found->last_name = $request->input('last_name');
      $lost_found->course = $request->input('course');

      // Save the updated model
      $lost_found->save();

      return redirect()->route('admin.lost_found_admin')->with('success', 'Lost and Found updated successfully');
  }

    public function destroy_lostFound(string $id)
    {
        $lost_found = Lost::findOrFail($id);

        $lost_found->delete();

        return redirect()->route('admin.lost_found_admin')->with('success', 'Lost and Found deleted successfully');
    }

    public function filterLostFoundAdmin(Request $request)
{
    $query = Lost::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    $lost_found = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.lost_found_admin', compact('lost_found'));
}
}
