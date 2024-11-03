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
use Exception;
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
        $query->whereDate('date', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('date', '<=', $request->end_date);
    }

    if ($request->filled('employee_type')) {
        $query->where('employee_type', $request->employee_type);
    }

    if ($request->filled('violation_filter')) {
        if ($request->violation_filter == '1') {
            $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
        } elseif ($request->violation_filter == '0') {
            $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
        }
    }

    $latestPassSlips = PassSlip::select('pass_slips.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date) as latest'), 'pass_slips.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date')) {
                $subQuery->whereDate('pass_slips.date', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $subQuery->whereDate('pass_slips.date', '<=', $request->end_date);
            }
            if ($request->filled('employee_type')) {
                $subQuery->where('pass_slips.employee_type', $request->employee_type);
            }
            if ($request->filled('violation_filter')) {
                if ($request->violation_filter == '1') {
                    $subQuery->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
                } elseif ($request->violation_filter == '0') {
                    $subQuery->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
                }
            }
        })
        ->latest()
        ->paginate()
        ->appends($request->all());

    $allPassSlips = $query->get();

    return view('sub-admin.pass_slip.pass_slip', compact('latestPassSlips', 'allPassSlips', 'request', 'user'));
}

    public function generateNextPassSub()
{
    $passNumber = $this->generatePassNoSub();

    return response()->json([
        'passNumber' => $passNumber,
    ]);
}

private function generatePassNoSub()
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


    public function store_slip(Request $request)
    {
        $request->validate([
            'p_no' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'destination' => 'required|string|max:100',
            'employee_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'time_out' => 'required|date_format:H:i',
            'check_business' => 'required|string',
            'driver_name' => 'nullable|alpha|max:100',
        ],
        [
            'destination.max' => 'Destination must be less than 100 characters.',
            'check_business.required' => 'Check Business is required.',
            'check_business.string' => 'Check Business must be a string.',
            'purpose.max' => 'Purpose must be less than 255 characters.',
            'driver_name.alpha' => 'Must no number or special characters.',
            'driver_name.max' => 'Driver Name must be less than 100 characters.',

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
            'time_out' => $request->time_out,
            'time_out_by' => Auth::user()->id,
            'check_business' => $request->check_business,
            'driver_name' => $request->driver_name,
        ]);


        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updatePassSlip(Request $request, string $id)
    {
        $passSlip = PassSlip::findOrFail($id);



        $passSlip->time_in = $request->input('time_in') ?? now()->format('H:i:s');
        $passSlip->time_in_by = Auth::user()->id;

        $timeIn = \Carbon\Carbon::parse($passSlip->time_in);
        $timeOut = \Carbon\Carbon::parse($passSlip->time_out);

        $timeDifference = $timeOut->diffInHours($timeIn);

        $passSlip->is_exceeded = $timeDifference >= 3;

        $passSlip->p_no = $request->input('p_no');
        $passSlip->first_name = $request->input('first_name');
        $passSlip->middle_name = $request->input('middle_name');
        $passSlip->last_name = $request->input('last_name');
        $passSlip->department = $request->input('department');
        $passSlip->designation = $request->input('designation');
        $passSlip->destination = $request->input('destination');
        $passSlip->employee_type = $request->input('employee_type');
        $passSlip->purpose = $request->input('purpose');
        $passSlip->time_out = $request->input('time_out');
        $passSlip->check_business = $request->input('check_business');
        $passSlip->driver_name = $request->input('driver_name');

        $passSlip->save();

        return redirect()->route('sub-admin.pass_slip.pass_slip')
            ->with('success', 'Pass Slip updated successfully');
    }


public function checkoutPassSlip($id)
{
    $pass_slip = PassSlip::findOrFail($id);

    $currentTime = now();
    $pass_slip->time_in = $currentTime->format('H:i:s');
    $pass_slip->time_in_by = Auth::user()->id;

    $timeOut = \Carbon\Carbon::parse($pass_slip->time_out);
    $timeDifference = $timeOut->diffInHours($currentTime);

    if ($timeDifference >= 3) {
        $pass_slip->is_exceeded = true;
    }

    // Save the pass slip record
    $pass_slip->save();

    return redirect()->route('sub-admin.pass_slip.pass_slip')->with('success', 'Time In recorded successfully.');
}

public function pass_slip_admin(Request $request)
{
    return $this->filterPassSlipAdmin($request);
}

public function filterPassSlipAdmin(Request $request)
{
    $query = PassSlip::query();
    $user = Auth::user();


    if ($request->filled('start_date')) {
        $query->whereDate('date', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('date', '<=', $request->end_date);
    }

    if ($request->filled('employee_type')) {
        $query->where('employee_type', $request->employee_type);
    }

    if ($request->filled('violation_filter')) {
        if ($request->violation_filter == '1') {
            $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
        } elseif ($request->violation_filter == '0') {
            $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
        }
    }

    $latestPassSlips = PassSlip::select('pass_slips.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date) as latest'), 'pass_slips.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date')) {
                $subQuery->whereDate('pass_slips.date', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $subQuery->whereDate('pass_slips.date', '<=', $request->end_date);
            }
            if ($request->filled('employee_type')) {
                $subQuery->where('pass_slips.employee_type', $request->employee_type);
            }
            if ($request->filled('violation_filter')) {
                if ($request->violation_filter == '1') {
                    $subQuery->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
                } elseif ($request->violation_filter == '0') {
                    $subQuery->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
                }
            }
        })
        ->latest()
        ->paginate()
        ->appends($request->all());

    // Fetch all pass slips for viewing older entries in modal
    $allPassSlips = $query->get();

    return view('admin.pass_slip.pass_slip_admin', compact('latestPassSlips', 'allPassSlips', 'user', 'request'));
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
            'destination' => 'required|string|max:100',
            'employee_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'time_out' => 'required|date_format:H:i',
            'check_business' => 'required|string',
            'driver_name' => 'nullable|alpha|max:100',
        ],
        [
            'destination.max' => 'Destination must be less than 100 characters.',
            'check_business.required' => 'Check Business is required.',
            'check_business.string' => 'Check Business must be a string.',
            'purpose.max' => 'Purpose must be less than 255 characters.',
            'driver_name.alpha' => 'Must no number or special characters.',
            'driver_name.max' => 'Driver Name must be less than 100 characters.',

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
            'time_out' => $request->time_out,
            'time_out_by' => Auth::user()->id,
            'check_business' => $request->check_business,
            'driver_name' => $request->driver_name,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function checkoutAdmin($id)
    {
        $pass_slip = PassSlip::findOrFail($id);
        $currentTime = now();
        $pass_slip->time_in = $currentTime->format('H:i:s');
        $pass_slip->time_in_by = Auth::user()->id;

        $timeOut = \Carbon\Carbon::parse($pass_slip->time_out);
        $timeDifference = $timeOut->diffInHours($currentTime);

        if ($timeDifference >= 3) {
            $pass_slip->is_exceeded = true;
        }
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

    public function searchEmployee(Request $request)
    {
        try {
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
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function searchTest() {
        return response()->json(['success' => true]);
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
