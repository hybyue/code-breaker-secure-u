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
    $request->filled('employee_type') || $request->filled('violation_filter')) {
    session(['pass_slip_filter' => [
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'employee_type' => $request->employee_type,
        'violation_filter' => $request->violation_filter
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

if (!empty($filterData['violation_filter'])) {
    if ($filterData['violation_filter'] == '1') {
        $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
    } elseif ($filterData['violation_filter'] == '0') {
        $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
    }
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
        if (!empty($filterData['violation_filter'])) {
            if ($filterData['violation_filter'] == '1') {
                $subQuery->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
            } elseif ($filterData['violation_filter'] == '0') {
                $subQuery->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
            }
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
        $validatedData = Validator::make($request->all(), [
            'destination' => 'required|string|max:100',
            'employee_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'time_out' => 'required',
            'time_in' => 'required',
            'check_business' => 'required|string',
            'driver_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:100',
        ], [
            'destination.max' => 'Destination must be less than 100 characters.',
            'check_business.required' => 'Check Business is required.',
            'check_business.string' => 'Check Business must be a string.',
            'purpose.max' => 'Purpose must be less than 255 characters.',
            'driver_name.regex' => 'Driver Name must contain letters and spaces only, with no numbers or special characters.',
            'driver_name.max' => 'Driver Name must be less than 100 characters.',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $passSlips = PassSlip::findOrFail($id);

        // Format time_in and time_out to 12-hour format with AM/PM
        $timeIn = Carbon::parse($request->input('time_in'))->format('H:i:s');
        $timeOut = Carbon::parse($request->input('time_out'))->format('H:i:s');

        $passSlips->time_in = $timeIn;
        $passSlips->time_out = $timeOut;

        // Calculate late duration using the calculateLateMinutes function
        $lateDuration = $this->calculateLateMinutes($timeOut, $timeIn);
        $passSlips->late_minutes = $lateDuration['total_minutes'];
        $passSlips->is_exceeded = $lateDuration['total_minutes'] > 0;

        // Calculate if exceeded 3 hours
        $timeDifference = Carbon::parse($timeOut)->diffInHours(Carbon::parse($timeIn));
        $isExceeded = $timeDifference >= 3;

        // Update all fields including both late_minutes and exceeded status
        $passSlips->update(array_merge(
            $request->all(),
            [
                'time_in' => $timeIn,
                'time_out' => $timeOut,
                'late_minutes' => $lateDuration['total_minutes'],
                'is_exceeded' => $isExceeded || $lateDuration['total_minutes'] > 0 // Exceeded if either condition is true
            ]
        ));

        $message = 'Pass slip updated successfully';
        if ($isExceeded) {
            $message .= ". Exceeded 3 hours";
            if ($lateDuration['total_minutes'] > 0) {
                $message .= " and was " . $lateDuration['formatted'] . " late";
            }
        } elseif ($lateDuration['total_minutes'] > 0) {
            $message .= ". Employee was " . $lateDuration['formatted'] . " late";
        }
        $message .= ".";


        return response()->json([
            'success' => true,
        ]);
    }



// public function checkoutPassSlip($id)
// {
//     $pass_slip = PassSlip::findOrFail($id);

//     $currentTime = now();
//     $pass_slip->time_in = $currentTime->format('H:i:s');
//     $pass_slip->time_in_by = Auth::user()->id;

//     $timeOut = \Carbon\Carbon::parse($pass_slip->time_out);
//     $timeDifference = $timeOut->diffInHours($currentTime);

//     if ($timeDifference >= 3) {
//         $pass_slip->is_exceeded = true;
//     }

//     // Save the pass slip record
//     $pass_slip->save();

//     return redirect()->route('sub-admin.pass_slip.pass_slip')->with('success', 'Time In recorded successfully.');
// }

public function pass_slip_admin(Request $request)
{
    return $this->filterPassSlipAdmin($request);
}

public function filterPassSlipAdmin(Request $request)
{
    if ($request->filled('start_date') || $request->filled('end_date') ||
    $request->filled('employee_type') || $request->filled('violation_filter')) {
    session(['pass_slip_filter' => [
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'employee_type' => $request->employee_type,
        'violation_filter' => $request->violation_filter
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

if (!empty($filterData['violation_filter'])) {
    if ($filterData['violation_filter'] == '1') {
        $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
    } elseif ($filterData['violation_filter'] == '0') {
        $query->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
    }
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
        if (!empty($filterData['violation_filter'])) {
            if ($filterData['violation_filter'] == '1') {
                $subQuery->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) >= 3');
            } elseif ($filterData['violation_filter'] == '0') {
                $subQuery->whereRaw('TIMESTAMPDIFF(HOUR, time_out, IFNULL(time_in, NOW())) < 3');
            }
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

    // public function checkoutAdmin($id)
    // {
    //     $pass_slip = PassSlip::findOrFail($id);
    //     $currentTime = now();
    //     $pass_slip->time_in = $currentTime->format('H:i:s');
    //     $pass_slip->time_in_by = Auth::user()->id;

    //     $timeOut = \Carbon\Carbon::parse($pass_slip->time_out);
    //     $timeDifference = $timeOut->diffInHours($currentTime);

    //     if ($timeDifference >= 3) {
    //         $pass_slip->is_exceeded = true;
    //     }
    //     $pass_slip->save();

    //     return redirect()->route('admin.pass_slip.pass_slip_admin')->with('success', 'Time In recorded successfully.');
    // }

    public function updatePassSlipAdmin(Request $request, string $id)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'destination' => 'required|string|max:100',
                'employee_type' => 'required|string|max:255',
                'purpose' => 'required|string|max:255',
                'time_out' => 'required',
                'time_in' => 'required',
                'check_business' => 'required|string',
                'driver_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:100',
            ]);

            if ($validatedData->fails()) {
                return response()->json(['errors' => $validatedData->errors()], 422);
            }

            $passSlips = PassSlip::findOrFail($id);

            // Convert 12-hour format to 24-hour format with seconds
            $timeIn = Carbon::parse($request->input('time_in'))
                ->format('H:i:s'); // This will convert to 24-hour format with seconds
            $timeOut = Carbon::parse($request->input('time_out'))
                ->format('H:i:s');

            // Calculate late duration using the calculateLateMinutes function
            $lateDuration = $this->calculateLateMinutes($timeOut, $timeIn);
            $passSlips->late_minutes = $lateDuration['total_minutes'];

            // Calculate if exceeded 3 hours
            $timeDifference = Carbon::parse($timeOut)->diffInHours(Carbon::parse($timeIn));
            $isExceeded = $timeDifference >= 3;

            // Update all fields including both late_minutes and exceeded status
            $passSlips->update(array_merge(
                $request->except(['time_in', 'time_out']), // Exclude times from request data
                [
                    'time_in' => $timeIn,
                    'time_out' => $timeOut,
                    'late_minutes' => $lateDuration['total_minutes'],
                    'is_exceeded' => $isExceeded || $lateDuration['total_minutes'] > 0 // Exceeded if either condition is true
                ]
            ));

            $message = 'Pass slip updated successfully';
            if ($isExceeded) {
                $message .= ". Exceeded 3 hours";
                if ($lateDuration['total_minutes'] > 0) {
                    $message .= " and was " . $lateDuration['formatted'] . " late";
                }
            } elseif ($lateDuration['total_minutes'] > 0) {
                $message .= ". Employee was " . $lateDuration['formatted'] . " late";
            }
            $message .= ".";

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            Log::error('Update Pass Slip Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the pass slip: ' . $e->getMessage()
            ], 500);
        }
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
public function calculateLateMinutes($timeOut, $timeIn)
{
    // Convert strings to Carbon instances if they aren't already
    $timeOut = Carbon::parse($timeOut);
    $timeIn = Carbon::parse($timeIn);

    // Calculate the time difference in minutes
    $diffInMinutes = $timeOut->diffInMinutes($timeIn);

    // If the difference is more than 3 hours (180 minutes), calculate how many minutes over
    if ($diffInMinutes > 180) {
        $lateMinutes = $diffInMinutes - 180;

        // Convert to hours and minutes if more than 60 minutes
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

    // If not over 3 hours, return 0
    return [
        'total_minutes' => 0,
        'formatted' => '0'
    ];
}

// Update the checkout methods to use the new format
public function checkoutAdmin($id)
{
    $pass_slip = PassSlip::findOrFail($id);
    $currentTime = now();

    $pass_slip->time_in = $currentTime->format('H:i:s');
    $pass_slip->time_in_by = Auth::user()->id;

    // Calculate late duration using the calculateLateMinutes function
    $lateDuration = $this->calculateLateMinutes($pass_slip->time_out, $currentTime);
    $pass_slip->late_minutes = $lateDuration['total_minutes'];
    $pass_slip->is_exceeded = $lateDuration['total_minutes'] > 0;

    // Calculate if exceeded 3 hours
    $timeDifference = Carbon::parse($pass_slip->time_out)->diffInHours($currentTime);
    $isExceeded = $timeDifference >= 3;

    // Set is_exceeded if either condition is true
    $pass_slip->is_exceeded = $isExceeded || $lateDuration['total_minutes'] > 0;

    // Save the pass slip record
    $pass_slip->save();

    $message = 'Time In recorded successfully';
    if ($isExceeded) {
        $message .= ". Exceeded 3 hours";
        if ($lateDuration['total_minutes'] > 0) {
            $message .= " and was " . $lateDuration['formatted'] . " late";
        }
    } elseif ($lateDuration['total_minutes'] > 0) {
        $message .= ". Employee was " . $lateDuration['formatted'] . " late";
    }
    $message .= ".";

    return redirect()->route('admin.pass_slip.pass_slip_admin')
        ->with('success', $message);
}

public function checkoutPassSlip($id)
{
    $pass_slip = PassSlip::findOrFail($id);
    $currentTime = now();

    $pass_slip->time_in = $currentTime->format('H:i:s');
    $pass_slip->time_in_by = Auth::user()->id;

    // Calculate late duration using the calculateLateMinutes function
    $lateDuration = $this->calculateLateMinutes($pass_slip->time_out, $currentTime);
    $pass_slip->late_minutes = $lateDuration['total_minutes'];
    $pass_slip->is_exceeded = $lateDuration['total_minutes'] > 0;

    // Calculate if exceeded 3 hours
    $timeDifference = Carbon::parse($pass_slip->time_out)->diffInHours($currentTime);
    $isExceeded = $timeDifference >= 3;

    // Set is_exceeded if either condition is true
    $pass_slip->is_exceeded = $isExceeded || $lateDuration['total_minutes'] > 0;

    // Save the pass slip record
    $pass_slip->save();

    $message = 'Time In recorded successfully';
    if ($isExceeded) {
        $message .= ". Exceeded 3 hours";
        if ($lateDuration['total_minutes'] > 0) {
            $message .= " and was " . $lateDuration['formatted'] . " late";
        }
    } elseif ($lateDuration['total_minutes'] > 0) {
        $message .= ". Employee was " . $lateDuration['formatted'] . " late";
    }
    $message .= ".";

    return redirect()->route('sub-admin.pass_slip.pass_slip')
        ->with('success', $message);
}
}
