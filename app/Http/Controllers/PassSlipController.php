<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllEmployee;
use App\Models\PassSlip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PassSlipController extends Controller
{
    public function pass_slip(Request $request)
    {
        return $this->filterPassSlip($request);
    }

    public function filterPassSlip(Request $request)
    {
        $query = PassSlip::query();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('employee_type')) {
            $query->where('employee_type', $request->employee_type);
        }

        // Fetch the latest pass slips per user for the specified date range
        $latestPassSlips = PassSlip::select('pass_slips.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date) as latest'), 'pass_slips.id', '=', 'latest.id')
            ->where(function ($subQuery) use ($request) {
                if ($request->filled('start_date')) {
                    $subQuery->whereDate('pass_slips.created_at', '>=', $request->start_date);
                }
                if ($request->filled('end_date')) {
                    $subQuery->whereDate('pass_slips.created_at', '<=', $request->end_date);
                }
                if ($request->filled('employee_type')) {
                    $subQuery->where('pass_slips.employee_type', $request->employee_type);
                }
            })
            ->latest()
            ->paginate() // Paginate results
            ->appends($request->all()); // Append filters to pagination links

        // Fetch all pass slips for viewing older entries in modal
        $allPassSlips = $query->get();

        return view('sub-admin.pass_slip.pass_slip', compact('latestPassSlips', 'allPassSlips'));
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
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'required|date_format:H:i',
        ]);

        $passSlip = new PassSlip();

        $passSlip->user_id = Auth::id();
        $passSlip->p_no = $request->p_no;
        $passSlip->first_name = $request->first_name;
        $passSlip->middle_name = $request->middle_name;
        $passSlip->last_name = $request->last_name;
        $passSlip->department = $request->department;
        $passSlip->designation = $request->designation;
        $passSlip->destination = $request->destination;
        $passSlip->employee_type = $request->employee_type;
        $passSlip->purpose = $request->purpose;
        $passSlip->time_in = $request->time_in;
        $passSlip->time_out = $request->time_out;
        $passSlip->date = now()->format('Y-m-d H:i:s') ;

        $passSlip->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updatePassSlip(Request $request, string $id)
{
    $passSlips = PassSlip::findOrFail($id);

    $passSlips->update($request->all());

    return redirect()->route('sub-admin.pass_slip.pass_slip')->with('success', 'Pass Slip updated successfully');
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
        ->latest()
        ->paginate();

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
            'date' => now()->format('Y-m-d H:i:s'),
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

    public function searchEmployee(Request $request) {
        $query = AllEmployee::query();

        // Check if search term is ID or name
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('employee_id', $searchTerm)
                  ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('last_name', 'like', '%' . $searchTerm . '%');

        }

        $employees = $query->limit(5)->get();

        if ($employees->count() > 0) {
            return response()->json(['success' => true, 'employees' => $employees]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
