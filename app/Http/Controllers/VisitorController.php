<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lost;
use App\Models\PassSlip;
use App\Models\Violation;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class VisitorController extends Controller
{
    public function index(Request $request)
{
    return $this->filterVisitorAdmin($request);
}

public function filterVisitorAdmin(Request $request)
{
    if ($request->filled('start_date') || $request->filled('end_date')) {
        session(['visitor_filter_admin' => [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]]);
    }
        $query = Visitor::query();
        $user = Auth::user();

    $filterData = session('visitor_filter_admin', [
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    if (!empty($filterData['start_date'])) {
        $query->whereDate('date', '>=', $filterData['start_date']);
    }

    if (!empty($filterData['end_date'])) {
        $query->whereDate('date', '<=', $filterData['end_date']);
    }

        $latestVisitors = Visitor::select('visitors.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date, id_type) as latest'), 'visitors.id', '=', 'latest.id')
            ->where(function ($subQuery) use ($filterData) {
                if (!empty($filterData['start_date'])) {
                    $subQuery->whereDate('visitors.date', '>=', $filterData['start_date']);
                }
                if (!empty($filterData['end_date'])) {
                    $subQuery->whereDate('visitors.date', '<=', $filterData['end_date']);
                }
            })
            ->latest()
            ->get();

        $allVisitors = $query->get();

    return view('admin.visitors.visitor_admin', compact('latestVisitors', 'allVisitors', 'filterData'));
}

public function clearVisitorFilterAdmin()
{
    session()->forget('visitor_filter_admin');
    return redirect()->route('admin.visitors.visitor_admin');
}


public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        'middle_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:1',
        'last_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        'person_to_visit' => 'required|string|max:100',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:30',
        'id_number' => 'required|string|max:50',
        'remarks' => 'nullable|string|max:255',
    ],
    [
        'first_name.regex' => 'Must no number or syntax.',
        'first_name.max' => 'Reached maximum 50 letters.',
        'middle_name.max' => 'Only 1 letter needed.',
        'last_name.regex' => 'Must no number or syntax.',
        'last_name.max' => 'Reached maximum 50 letters.',
        'person_to_visit.string' => 'Must no number or syntax.',
        'person_to_visit.max' => 'Must below 100 letters',
        'purpose.string' => 'Must no number or syntax.',
        'purpose.max' => 'Must below 255 letters.',
        'id_type.string' => 'Must no number or syntax.',
        'id_type.max' => 'Must be below 30 letters.',
        'id_number.required' => 'ID Number is required.',
        'id_number.max' => 'ID Number must be below 50 characters.',
    ]
);

    $visitor = new Visitor();
    $visitor->first_name = $request->first_name;
    $visitor->middle_name = $request->middle_name;
    $visitor->last_name = $request->last_name;
    $visitor->person_to_visit = $request->person_to_visit;
    $visitor->purpose = $request->purpose;
    $visitor->id_type = $request->id_type;
    $visitor->id_number = $request->id_number;
    $visitor->remarks = $request->remarks ?? null;
    $visitor->date = now()->format('Y-m-d H:i:s');
    $visitor->time_in = now()->format('H:i:s');
    $visitor->user_id = Auth::id();


    $visitor->save();

    return response()->json(['status' => 'success', 'message' => 'Visitor added successfully', 'visitor' => $visitor]);

}


public function edit(string $id)
{
    $visitors = Visitor::findOrFail($id);

    return view('employee.edit', compact('visitors'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, String $id)
{
    $visitor = Visitor::findOrFail($id);

    $validatedData = Validator::make($request->all(), [
        'first_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        'middle_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:1',
        'last_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        'person_to_visit' => 'required|string|max:100',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:30',
        'id_number' => 'required|string|max:50',
        'visited_person_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:100',
        'visited_person_position' => 'nullable|regex:/^[A-Za-z\s]+$/|max:100',
        'id_number' => 'required|string|max:50',
        'remarks' => 'nullable|string|max:255',
    ],
    [
        'first_name.regex' => 'Must no number or syntax.',
        'first_name.max' => 'Reached maximum 50 letters.',
        'middle_name.max' => 'Only 1 letter needed.',
        'last_name.regex' => 'Must no number or syntax.',
        'last_name.max' => 'Reached maximum 50 letters.',
        'person_to_visit.string' => 'Must no number or syntax.',
        'person_to_visit.max' => 'Must below 100 letters',
        'purpose.string' => 'Must no number or syntax.',
        'purpose.max' => 'Must below 255 letters.',
        'id_type.string' => 'Must no number or syntax.',
        'id_type.max' => 'Must be below 30 letters.',
        'visited_person_name.max' => 'Must below 100 letters',
        'visited_person_position.max' => 'Must below 100 letters',
        'id_number.required' => 'ID Number is required.',
        'id_number.max' => 'ID Number must be below 50 characters.',
    ]);

    if ($validatedData->fails()) {
        return response()->json(['errors' => $validatedData->errors()], 422);
    }

    $visitor->visited_person_name = $request->input('visited_person_name');
    $visitor->visited_person_position = $request->input('visited_person_position');
    $visitor->id_number = $request->input('id_number');

    $visitor->update($request->all());


    return response()->json([
        'success' => true,
        'message' => 'Visitor updated successfully.'
    ]);
}


/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $visitors = Visitor::findOrFail($id);

    $visitors->delete();

    return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
}

public function checkoutAdmin($id)
{
    $visitor = Visitor::findOrFail($id);
    request()->validate([
        'visited_person_name' => 'required|regex:/^[A-Za-z\s]+$/|max:100',
        'visited_person_position' => 'required|string|max:100',
    ],
    [
        'visited_person_name.regex' => 'Must no number or syntax.',
        'visited_person_name.max' => 'Must below 100 letters',
        'visited_person_position.max' => 'Must below 100 letters',
    ]);

    $visitor->visited_person_name = request('visited_person_name');
    $visitor->visited_person_position = request('visited_person_position');
    $visitor->time_out = now();
    $visitor->save();

    return redirect()->route('admin.visitors.visitor_admin')->with('success', 'Time out recorded successfully.');
}

public function searchVisitors(Request $request)
{
    $query = $request->get('query');
    $visitors = Visitor::where('last_name', 'like', "%{$query}%")
                        ->orWhere('first_name', 'like', "%{$query}%")
                        ->orWhere('middle_name', 'like', "%{$query}%")
                        ->get();
    return response()->json($visitors);
}


//SUB-ADMIN VIITOR REQUEST
public function new_visitor(Request $request)
{
    return $this->filterVisitor($request);
}

public function filterVisitor(Request $request)
{
    if ($request->filled('start_date') || $request->filled('end_date')) {
    session(['visitor_filter' => [
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]]);
}
    $query = Visitor::query();
    $user = Auth::user();

$filterData = session('visitor_filter', [
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
]);

if (!empty($filterData['start_date'])) {
    $query->whereDate('date', '>=', $filterData['start_date']);
}

if (!empty($filterData['end_date'])) {
    $query->whereDate('date', '<=', $filterData['end_date']);
}

    $latestVisitors = Visitor::select('visitors.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date, id_type, id_number) as latest'), 'visitors.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($filterData) {
            if (!empty($filterData['start_date'])) {
                $subQuery->whereDate('visitors.date', '>=', $filterData['start_date']);
            }
            if (!empty($filterData['end_date'])) {
                $subQuery->whereDate('visitors.date', '<=', $filterData['end_date']);
            }
        })
        ->latest()
        ->get();

    $allVisitors = $query->get();

    return view('sub-admin.visitors.visitor', compact('latestVisitors', 'allVisitors', 'filterData'));
}

public function clearVisitorFilter()
{
    session()->forget('visitor_filter');
    return redirect()->route('sub-admin.visitors.visitor');
}

public function store_visit(Request $request)
{
    $request->validate([
        'first_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        'middle_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:1',
        'last_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        'person_to_visit' => 'required|string|max:100',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:30',
        'id_number' => 'required|string|max:50',
        'remarks' => 'nullable|string|max:255',
    ],
    [
        'first_name.regex' => 'Must no number or syntax.',
        'first_name.max' => 'Reached maximum 50 letters.',
        'middle_name.max' => 'Only 1 letter needed.',
        'last_name.regex' => 'Must no number or syntax.',
        'last_name.max' => 'Reached maximum 50 letters.',
        'person_to_visit.string' => 'Must no number or syntax.',
        'person_to_visit.max' => 'Must below 100 letters',
        'purpose.string' => 'Must no number or syntax.',
        'purpose.max' => 'Must below 255 letters.',
        'id_type.string' => 'Must no number or syntax.',
        'id_type.max' => 'Must be below 30 letters.',
        'id_number.required' => 'ID Number is required.',
        'id_number.max' => 'ID Number must be below 50 characters.',
    ]
);

    $visitor = new Visitor();
    $visitor->first_name = $request->first_name;
    $visitor->middle_name = $request->middle_name;
    $visitor->last_name = $request->last_name;
    $visitor->person_to_visit = $request->person_to_visit;
    $visitor->purpose = $request->purpose;
    $visitor->id_type = $request->id_type;
    $visitor->id_number = $request->id_number;
    $visitor->date = now()->format('Y-m-d H:i:s');
    $visitor->time_in = now()->format('H:i:s');
    $visitor->user_id = Auth::id();
    $visitor->remarks = $request->remarks ?? null;
    $visitor->save();


    return response()->json([
        'status' => 'success'
    ]);
}

public function validateField(Request $request)
{
    $field = $request->input('field');
    $value = $request->input('value');

    $rules = [
        'first_name' => 'required|string|max:50',
        'middle_name' => 'nullable|string|max:1',
        'last_name' => 'required|string|max:50',
        'person_to_visit' => 'required|string|max:100',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:30',
    ];

    $validator = Validator::make([$field => $value], [$field => $rules[$field]]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    return response()->json(['status' => 'valid']);
}


public function checkout($id)
{
    $visitor = Visitor::findOrFail($id);

    // Add validation for the new fields
    request()->validate([
        'visited_person_name' => 'required|regex:/^[A-Za-z\s]+$/|max:100',
        'visited_person_position' => 'required|string|max:100',
    ],
    [
        'visited_person_name.regex' => 'Must no number or syntax.',
        'visited_person_name.max' => 'Must below 100 letters',
        'visited_person_position.max' => 'Must below 100 letters',
    ]);

    $visitor->visited_person_name = request('visited_person_name');
    $visitor->visited_person_position = request('visited_person_position');
    $visitor->time_out = now();
    $visitor->save();

    return redirect()->route('sub-admin.visitors.visitor')->with('success', 'Visitor timed out successfully.');
}

public function searchVisitor(Request $request)
{
    $query = $request->get('query');
    $visitors = Visitor::where('last_name', 'like', "%{$query}%")
                        ->orWhere('first_name', 'like', "%{$query}%")
                        ->orWhere('middle_name', 'like', "%{$query}%")
                        ->get();
    return response()->json($visitors);
}

public function updateVisitorSub(Request $request, string $id)
{
    $validatedData = Validator::make($request->all(), [
        'first_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        'middle_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:1',
        'last_name' => 'required|regex:/^[A-Za-z\s]+$/|max:50',
        'person_to_visit' => 'required|string|max:100',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:30',
        'id_number' => 'required|string|max:50',
        'visited_person_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:100',
        'visited_person_position' => 'nullable|regex:/^[A-Za-z\s]+$/|max:100',
        'remarks' => 'nullable|string|max:255',
    ],
    [
        'first_name.regex' => 'Must no number or syntax.',
        'first_name.max' => 'Reached maximum 50 letters.',
        'middle_name.max' => 'Only 1 letter needed.',
        'last_name.regex' => 'Must no number or syntax.',
        'last_name.max' => 'Reached maximum 50 letters.',
        'person_to_visit.string' => 'Must no number or syntax.',
        'person_to_visit.max' => 'Must below 100 letters',
        'purpose.string' => 'Must no number or syntax.',
        'purpose.max' => 'Must below 255 letters.',
        'id_type.string' => 'Must no number or syntax.',
        'id_type.max' => 'Must be below 30 letters.',
        'visited_person_name.max' => 'Must below 100 letters',
        'visited_person_position.max' => 'Must below 100 letters',
        'id_number.required' => 'ID Number is required.',
        'id_number.max' => 'ID Number must be below 50 characters.',
    ]);

    if ($validatedData->fails()) {
        return response()->json(['errors' => $validatedData->errors()], 422);
    }

    $visitor = Visitor::findOrFail($id);

    $visitor->visited_person_name = $request->input('visited_person_name');
    $visitor->visited_person_position = $request->input('visited_person_position');
    $visitor->id_number = $request->input('id_number');
    $visitor->update($request->all());

    return response()->json([
        'success' => true,
        'message' => 'Visitor updated successfully.',
        'redirect_url' => route('sub-admin.visitors.visitor')
    ]);
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

    public function duplicateEntry($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);

            // Create a new visitor entry with the same details
            $newVisitor = $visitor->replicate();
            $newVisitor->time_in = now();
            $newVisitor->time_out = null;
            $newVisitor->date = now()->format('Y-m-d H:i:s');
            $newVisitor->save();

            // Update the latestVisitors query to group by name and fields
            $latestVisitors = Visitor::select('visitors.*')
                ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date, id_type) as latest'),
                    'visitors.id', '=', 'latest.id')
                ->latest()
                ->get();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function duplicateEntrySubAdmin($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);

            // Create a new visitor entry with the same details
            $newVisitor = $visitor->replicate();
            $newVisitor->time_in = now();
            $newVisitor->time_out = null;
            $newVisitor->date = now()->format('Y-m-d H:i:s');
            $newVisitor->save();

            // Update the latestVisitors query to group by name and fields
            $latestVisitors = Visitor::select('visitors.*')
                ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date, id_type) as latest'),
                    'visitors.id', '=', 'latest.id')
                ->latest()
                ->get();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
