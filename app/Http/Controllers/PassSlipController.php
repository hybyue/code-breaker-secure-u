<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllEmployee;
use App\Models\Lost;
use App\Models\PassSlip;
use App\Models\Violation;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PassSlipController extends Controller
{
    public function pass_slip(Request $request)
    {
        return $this->filterPassSlip($request);
    }

    public function filterPassSlip(Request $request)
{
    if ($request->filled('start_date') || $request->filled('end_date') ||
    $request->filled('employee_type')) {
    session(['pass_slip_filter' => [
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'employee_type' => $request->employee_type,
    ]]);
}

$query = PassSlip::query();
$user = Auth::user();

// Get filter data from session or request
$filterData = session('pass_slip_filter', [
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'employee_type' => $request->employee_type,
]);

// Apply filters
if (!empty($filterData['start_date'])) {
    $query->whereDate('date', '>=', $filterData['start_date']);
}

if (!empty($filterData['end_date'])) {
    $query->whereDate('date', '<=', $filterData['end_date']);
}

if (!empty($filterData['employee_type'])) {
    $query->where('employee_type', $filterData['employee_type']);
}



// Update to use $filterData instead of $request
$latestPassSlips = PassSlip::select('pass_slips.*')
    ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date, department, designation) as latest'),
        'pass_slips.id', '=', 'latest.id')
    ->where(function ($subQuery) use ($filterData) {
        if (!empty($filterData['start_date'])) {
            $subQuery->whereDate('pass_slips.date', '>=', $filterData['start_date']);
        }
        if (!empty($filterData['end_date'])) {
            $subQuery->whereDate('pass_slips.date', '<=', $filterData['end_date']);
        }
        if (!empty($filterData['employee_type'])) {
            $subQuery->where('pass_slips.employee_type', $filterData['employee_type']);
        }
    })
    ->latest()
    ->get();

$allPassSlips = $query->get();

return view('sub-admin.pass_slip.pass_slip', compact('latestPassSlips', 'allPassSlips', 'request', 'user', 'filterData'));
}


public function clearPassSlipFilter()
{
    session()->forget('pass_slip_filter');
    return redirect()->route('sub-admin.pass_slip.pass_slip');
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
        // Extract the number after the last dash
        $latestNumber = (int) substr($latestPassSlip->p_no, strrpos($latestPassSlip->p_no, '-') + 1);
        $nextNumber = $latestNumber + 1;
    } else {
        $nextNumber = 1;
    }

    // Generate the new pass slip number
    $newPassNumber = 'P-' . $date . '-' . $nextNumber;

    return $newPassNumber;
}


        public function store_slip(Request $request)
        {
            $request->validate([
                'p_no' => 'required|string|max:255',
                'first_name' => 'required|string|max:100',
                'middle_name' => 'nullable|string|max:100',
                'last_name' => 'required|string|max:100',
                'department' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'destination' => 'required|string|max:100',
                'employee_type' => 'required|string|max:255',
                'purpose' => 'required|string|max:255',
                'time_out' => 'required|date_format:H:i',
                'check_business' => 'required|string',
                'driver_name' => 'nullable|string|max:100',
                'remarks' => 'nullable|string|max:255',
                'validity_hours' => 'required|numeric|min:0.5',
            ], [
                'destination.max' => 'Destination must be less than 100 characters.',
                'check_business.required' => 'Check Business is required.',
                'check_business.string' => 'Check Business must be a string.',
                'purpose.max' => 'Purpose must be less than 255 characters.',
                'driver_name.max' => 'Driver Name must be less than 100 characters.',
                'validity_hours.required' => 'Validity period is required.',
                'validity_hours.numeric' => 'Validity must be a number.',
                'validity_hours.min' => 'Validity must be at least 30 minutes.',
            ]);

             // Check if there is a pending pass slip (time_in is null)
            $pendingSlip = PassSlip::where('date', now()->format('Y-m-d'))
            ->where('first_name', $request->first_name)
            ->where('middle_name', $request->middle_name)
            ->where('last_name', $request->last_name)
            ->where('designation', $request->designation)
            ->where('department', $request->department)
            ->where('employee_type', $request->employee_type)
            ->whereNull('time_in')
            ->exists();

        if ($pendingSlip) {
            return response()->json([
                'status' => 'error',
                'message' => 'The employee still has a pending pass slip without time-in. Cannot create a new pass slip.',
            ], 400);
        }

        // Check if the employee already has three pass slip records for the same date
        $existingSlipsCount = PassSlip::where('date', now()->format('Y-m-d'))
            ->where('first_name', $request->first_name)
            ->where('middle_name', $request->middle_name)
            ->where('last_name', $request->last_name)
            ->where('designation', $request->designation)
            ->where('department', $request->department)
            ->where('employee_type', $request->employee_type)
            ->count();

        if ($existingSlipsCount >= 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'The employee already has the maximum number of pass slips (3).',
            ], 400);
        }


            // Create the new pass slip
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
                'time_out' => Carbon::parse($request->time_out)->format('H:i'),
                'time_out_by' => Auth::user()->id,
                'check_business' => $request->check_business,
                'driver_name' => $request->driver_name,
                'remarks' => $request->remarks,
                'validity_hours' => $request->validity_hours,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Pass slip added successfully!'
            ]);
        }


    public function updatePassSlip(Request $request, string $id)
{
    try {
        $validatedData = Validator::make($request->all(), [
            'destination' => 'required|string|max:100',
            'employee_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'time_out' => 'required',
            'time_in' => 'nullable',
            'check_business' => 'required|string',
            'driver_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:100',
            'remarks' => 'nullable|string|max:255',
            'validity_hours' => 'required|numeric|min:0.5',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $passSlip = PassSlip::findOrFail($id);

        // Parse time_out
        $timeOut = Carbon::parse($request->input('time_out'));

        // Check if time_in is provided, otherwise set it to null
        $timeIn = $request->input('time_in') ? Carbon::parse($request->input('time_in')) : null;

        // Calculate late minutes and exceeded status
        $lateMinutesData = $this->calculateLateMinutes($timeOut, $timeIn, $request->validity_hours);
        $lateMinutes = $lateMinutesData['total_minutes'];
        $isExceeded = $lateMinutes > 0;

        // Update pass slip
        $passSlip->update([
            'time_in_by' => Auth::user()->id,
            'destination' => $request->destination,
            'employee_type' => $request->employee_type,
            'purpose' => $request->purpose,
            'check_business' => $request->check_business,
            'driver_name' => $request->driver_name,
            'remarks' => $request->remarks,
            'time_out' => $timeOut->format('H:i'),
            'time_in' => $timeIn ? $timeIn->format('H:i') : null,
            'validity_hours' => $request->validity_hours,
            'late_minutes' => $lateMinutes,
            'is_exceeded' => $isExceeded,
        ]);

        // Prepare response message
        $message = 'Pass slip updated successfully';
        if ($isExceeded) {
            $message .= ". Exceeded validity period by {$lateMinutesData['formatted']}";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);

    } catch (\Exception $e) {
        Log::error('Update Pass Slip Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while updating the pass slip: ' . $e->getMessage(),
        ], 500);
    }
}

public function pass_slip_admin(Request $request)
{
    return $this->filterPassSlipAdmin($request);
}

public function filterPassSlipAdmin(Request $request)
{
    if ($request->filled('start_date') || $request->filled('end_date') ||
    $request->filled('employee_type')) {
    session(['pass_slip_filter' => [
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'employee_type' => $request->employee_type,
    ]]);
}

$query = PassSlip::query();
$user = Auth::user();

// Get filter data from session or request
$filterData = session('pass_slip_filter', [
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'employee_type' => $request->employee_type,
    'violation_filter' => $request->violation_filter
]);

// Apply filters
if (!empty($filterData['start_date'])) {
    $query->whereDate('date', '>=', $filterData['start_date']);
}

if (!empty($filterData['end_date'])) {
    $query->whereDate('date', '<=', $filterData['end_date']);
}

if (!empty($filterData['employee_type'])) {
    $query->where('employee_type', $filterData['employee_type']);
}

// Update to use $filterData instead of $request
$latestPassSlips = PassSlip::select('pass_slips.*')
    ->join(DB::raw('(SELECT MAX(id) as id FROM pass_slips GROUP BY last_name, first_name, middle_name, date, department, designation) as latest'),
        'pass_slips.id', '=', 'latest.id')
    ->where(function ($subQuery) use ($filterData) {
        if (!empty($filterData['start_date'])) {
            $subQuery->whereDate('pass_slips.date', '>=', $filterData['start_date']);
        }
        if (!empty($filterData['end_date'])) {
            $subQuery->whereDate('pass_slips.date', '<=', $filterData['end_date']);
        }
        if (!empty($filterData['employee_type'])) {
            $subQuery->where('pass_slips.employee_type', $filterData['employee_type']);
        }
    })
    ->latest()
    ->get();

$allPassSlips = $query->get();

    return view('admin.pass_slip.pass_slip_admin', compact('latestPassSlips', 'allPassSlips', 'user', 'filterData'));
}

// Add a method to clear filters
public function clearPassSlipFilterAd()
{
    session()->forget('pass_slip_filter');
    return redirect()->route('admin.pass_slip.pass_slip_admin');
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
        // Extract the number after the last dash
        $latestNumber = (int) substr($latestPassSlip->p_no, strrpos($latestPassSlip->p_no, '-') + 1);
        $nextNumber = $latestNumber + 1;
    } else {
        $nextNumber = 1;
    }

    // Generate the new pass slip number
    $newPassNumber = 'P-' . $date . '-' . $nextNumber;

    return $newPassNumber;
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
                $query->where('employee_id', 'like', '%' . $searchTerm .  '%')
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




    public function getVisitorStats($timeframe)
    {
        switch ($timeframe) {
        case 'weekly':
                $data = Visitor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->get();
                break;
            case 'monthly':
                $data = Visitor::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month')
                    ->get();
                break;
            case 'yearly':
                $data = Visitor::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
                    ->groupBy('year')
                    ->get();
                break;
            default:
                return response()->json(['error' => 'Invalid timeframe'], 400);
        }

        return response()->json($data);
    }

    public function getVisitorData(Request $request)
    {
        $timePeriod = $request->query('timePeriod');
        $labels = [];
        $visitor_count = [];
        $pass_slip_count = [];
        $lost_found_count = [];
        $violation_count = [];

        $currentYear = date('Y');

        switch ($timePeriod) {
            case 'weekly':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();

                for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                    if ($date->dayOfWeek >= 1 && $date->dayOfWeek <= 5) {
                        $labels[] = $date->format('D');
                        $visitor_count[] = Visitor::whereDate('created_at', $date)->count();
                        $pass_slip_count[] = PassSlip::whereDate('created_at', $date)->count();
                        $lost_found_count[] = Lost::whereDate('created_at', $date)->count();
                        $violation_count[] = Violation::whereDate('created_at', $date)->count();
                    }
                }
                break;

            case 'monthly':
                for ($month = 1; $month <= 12; $month++) {
                    $labels[] = date('M', mktime(0, 0, 0, $month, 1));
                    $visitor_count[] = Visitor::whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $month)->count();
                    $pass_slip_count[] = PassSlip::whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $month)->count();
                    $lost_found_count[] = Lost::whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $month)->count();
                    $violation_count[] = Violation::whereYear('created_at', $currentYear)
                        ->whereMonth('created_at', $month)->count();
                }
                break;

            case 'yearly':
                $startYear = Visitor::min(DB::raw('YEAR(created_at)')) ?: $currentYear;
                for ($year = $startYear; $year <= $currentYear; $year++) {
                    $labels[] = $year;
                    $visitor_count[] = Visitor::whereYear('created_at', $year)->count();
                    $pass_slip_count[] = PassSlip::whereYear('created_at', $year)->count();
                    $lost_found_count[] = Lost::whereYear('created_at', $year)->count();
                    $violation_count[] = Violation::whereYear('created_at', $year)->count();
                }
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
    public function calculateLateMinutes($timeOut, $timeIn, $validityHours)
    {
        // Convert strings to Carbon instances
        $timeOut = Carbon::parse($timeOut);
        $timeIn = Carbon::parse($timeIn);

        // Convert validity hours to minutes
        $validityMinutes = $validityHours * 60;

        // Calculate the time difference in minutes between time out and time in
        $actualDuration = $timeOut->diffInMinutes($timeIn);

         Log::info("Actual Duration: $actualDuration minutes, Validity Minutes: $validityMinutes");

        // If the actual duration exceeds the validity period
        if ($actualDuration > $validityMinutes) {
            $lateMinutes = $actualDuration - $validityMinutes;

            // Convert to hours and minutes if necessary
            if ($lateMinutes >= 60) {
                $hours = floor($lateMinutes / 60);
                $minutes = $lateMinutes % 60;
                return [
                    'total_minutes' => $lateMinutes,
                    'formatted' => $hours . ' hr ' . ($minutes > 0 ? $minutes . ' min' : '')
                ];
            }

            return [
                'total_minutes' => $lateMinutes,
                'formatted' => $lateMinutes . ' min'
            ];
        }

        // If not late, return 0
        return [
            'total_minutes' => 0,
            'formatted' => '0 min'
        ];
    }

    public function checkoutAdmin($id)
{
    $pass_slip = PassSlip::findOrFail($id);
    $currentTime = now();

    $pass_slip->time_in = $currentTime->format('H:i');
    $pass_slip->time_in_by = Auth::user()->id;

    // Calculate late duration
    $lateDuration = $this->calculateLateMinutes($pass_slip->time_out, $currentTime, $pass_slip->validity_hours);
    $pass_slip->late_minutes = $lateDuration['total_minutes'];
    $pass_slip->is_exceeded = $lateDuration['total_minutes'] > 0;

    // Save the pass slip record
    $pass_slip->save();

    $message = 'Time In recorded successfully';
    if ($lateDuration['total_minutes'] > 0) {
        $message .= ". Exceeded validity period by " . $lateDuration['formatted'];
    }

    return redirect()->route('admin.pass_slip.pass_slip_admin')
        ->with('success', $message);
}


// Update the checkout methods to use the new format
public function checkoutPassSlip($id)
{
    $pass_slip = PassSlip::findOrFail($id);
    $currentTime = now();

    $pass_slip->time_in = $currentTime->format('H:i');
    $pass_slip->time_in_by = Auth::user()->id;

    // Calculate late duration
    $lateDuration = $this->calculateLateMinutes($pass_slip->time_out, $currentTime, $pass_slip->validity_hours);
    $pass_slip->late_minutes = $lateDuration['total_minutes'];
    $pass_slip->is_exceeded = $lateDuration['total_minutes'] > 0;

    // Save the pass slip record
    $pass_slip->save();

    $message = 'Time In recorded successfully';
    if ($lateDuration['total_minutes'] > 0) {
        $message .= ". Exceeded validity period by " . $lateDuration['formatted'];
    }

    return redirect()->route('sub-admin.pass_slip.pass_slip')
        ->with('success', $message);
}


private function isExceeded($passSlip, $timeIn)
{
    $timeOut = Carbon::parse($passSlip->time_out);
    $timeIn = Carbon::parse($timeIn);

    // Convert validity hours to minutes for precise calculation
    $validityMinutes = $passSlip->validity_hours * 60;

    // Calculate the actual duration in minutes
    $actualDuration = $timeOut->diffInMinutes($timeIn);

    return $actualDuration > $validityMinutes;
}
}
