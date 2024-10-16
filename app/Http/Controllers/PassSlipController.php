<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllEmployee;
use App\Models\Lost;
use App\Models\PassSlip;
use App\Models\Violation;
use App\Models\Visitor;
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
        $user = Auth::user();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('employee_type')) {
            $query->where('employee_type', $request->employee_type);
        }

        $latestPassSlips = PassSlip::select('pass_slips.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date, employee_type, designation, department) as latest'), 'pass_slips.id', '=', 'latest.id')
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
            ->paginate()
            ->appends($request->all());

        $allPassSlips = $query->get();

        return view('sub-admin.pass_slip.pass_slip', compact('latestPassSlips', 'allPassSlips', 'user', 'request'));
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
        $passSlip->time_out = $request->time_out;
        $passSlip->date = now()->format('Y-m-d');
        $passSlip->time_in = $request->has('time_in') ? $request->time_in : null;


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

    $latestPassSlips = PassSlip::select('pass_slips.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date, employee_type, designation, department) as latest'), 'pass_slips.id', '=', 'latest.id')
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

    $allPassSlips = $query->get();

    return view('admin.pass_slip.pass_slip_admin', compact('latestPassSlips', 'allPassSlips'));
}

public function generateNextPassNumber()
{
    $passNumber = $this->generatePassNumber();

    return response()->json([
        'passNumber' => $passNumber,
    ]);
}

private function generatePassNumber()
{
    $date = now()->format('Ymd');

    $latestPassSlip = DB::table('pass_slips')
        ->whereDate('created_at', now()->format('Y-m-d'))
        ->orderBy('p_no', 'desc')
        ->first();

    if ($latestPassSlip) {
        $latestNumber = (int) substr($latestPassSlip->p_no, -1);
        $nextNumber = $latestNumber + 1;
    } else {
        $nextNumber = 1;
    }

    $newPassNumber = 'P-' . $date . '-' . $nextNumber;

    return $newPassNumber;
}

    public function store_slip_admin(Request $request)
    {
        $passNumber = $this->generatePassNumber();

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
            'time_out' => 'required|date_format:H:i',
        ]);

        PassSlip::create([
            'user_id' => Auth::id(),
            'p_no' => $passNumber,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'department' => $request->department,
            'designation' => $request->designation,
            'destination' => $request->destination,
            'employee_type' => $request->employee_type,
            'purpose' => $request->purpose,
            'date' => now()->format('Y-m-d'),
            'time_out' => $request->time_out,
            'time_in' => $request->has('time_in') ? $request->time_in : null,
        ]);

        return response()->json([
            'status' => 'success',
            'passNumber' => $passNumber
        ]);
    }


    public function checkoutAdmin($id)
{
    $pass_slip = PassSlip::findOrFail($id);
    $pass_slip->time_in = now()->format('H:i:s');
    $pass_slip->save();

    return redirect()->route('admin.pass_slip.pass_slip_admin')->with('success', 'Time In recorded successfully.');
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

    public function checkoutPassSlip($id)
{
    $pass_slip = PassSlip::findOrFail($id);
    $pass_slip->time_in = now()->format('H:i:s');
    $pass_slip->save();

    return redirect()->route('sub-admin.pass_slip.pass_slip')->with('success', 'Time In recorded successfully.');
}


    public function getVisitorData(Request $request)
    {
        $timePeriod = $request->query('timePeriod');
        $labels = [];

        $visitor_count = [];
        $pass_slip_count = [];
        $lost_found_count = [];
        $violation_count = [];

        switch ($timePeriod) {
            case 'monthly':
                $visitors = Visitor::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

                $labels = $visitors->pluck('month')->toArray();
                $visitor_count = $visitors->pluck('count')->toArray();

                $pass_slips = PassSlip::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

                $labels = $pass_slips->pluck('month')->toArray();
                $pass_slip_count = $pass_slips->pluck('count')->toArray();

                $lost_found = Lost::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

                $labels = $lost_found->pluck('month')->toArray();
                $lost_found_count = $lost_found->pluck('count')->toArray();

                $violations = Violation::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

                $labels = $violations->pluck('month')->toArray();
                $violation_count = $violations->pluck('count')->toArray();
                break;
            case 'yearly':
                $visitors = Visitor::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get();

                $labels = $visitors->pluck('year')->toArray();
                $visitor_count = $visitors->pluck('total')->toArray();

                $pass_slips = PassSlip::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get();

                $labels = $pass_slips->pluck('year')->toArray();
                $pass_slip_count = $pass_slips->pluck('total')->toArray();

                $lost_found = Lost::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get();

                $labels = $lost_found->pluck('year')->toArray();
                $lost_found_count = $lost_found->pluck('total')->toArray();

                $violations = Violation::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get();

                $labels = $violations->pluck('year')->toArray();
                $violation_count = $violations->pluck('total')->toArray();
                break;
        }

        return response()->json([
            'labels' => $labels,
            'visitor' => $visitor_count,
            'passSlip' => $pass_slip_count,
            'lost' => $lost_found_count,
            'violation' => $violation_count
            ]);
    }

    public function getVisitorTotalData()
{
    $visitorCount = Visitor::count();
    $passSlipCount = PassSlip::count();
    $lostFoundCount = Lost::count();
    $violationCount = Violation::count();

    return response()->json([
        'visitor' => $visitorCount,
        'passSlip' => $passSlipCount,
        'lost' => $lostFoundCount,
        'violation' => $violationCount
    ]);
}
}
