<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DepartmentNotification;
use App\Models\Lost;
use App\Models\PassSlip;
use App\Models\Violation;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


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
        'first_name' => 'required|alpha|max:50',
        'middle_name' => 'nullable|alpha|max:1',
        'last_name' => 'required|alpha|max:50',
        'person_to_visit' => 'required|string|max:100',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:30',
    ],
    [
        'first_name.alpha' => 'Must no number or syntax.',
        'first_name.max' => 'Reached maximum 50 letters.',
        'middle_name.max' => 'Only 1 letter needed.',
        'last_name.alpha' => 'Must no number or syntax.',
        'last_name.max' => 'Reached maximum 50 letters.',
        'person_to_visit.string' => 'Must no number or syntax.',
        'person_to_visit.max' => 'Must below 100 letters',
        'purpose.string' => 'Must no number or syntax.',
        'purpose.max' => 'Must below 255 letters.',
        'id_type.string' => 'Must no number or syntax.',
        'id_type.max' => 'Must be below 30 letters.',
    ]);

    $visitor = new Visitor();
    $visitor->fill([
        'first_name' => $request->get('first_name'),
        'middle_name' => $request->get('middle_name'),
        'last_name' => $request->get('last_name'),
        'person_to_visit' => $request->get('person_to_visit'),
        'purpose' => $request->get('purpose'),
        'id_type' => $request->get('id_type'),
        'date' => now()->format('Y-m-d H:i:s'),
        'time_in' => now()->format('H:i:s'),
        'user_id' => Auth::id(),
    ]);

    $visitor->save();

    //Fetch the latest visitors
    $latestVisitor = Visitor::select('visitors.*')
    ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date, entry_count) as latest'), 'visitors.id', '=', 'latest.id')
    ->latest('visitors.created_at')
    ->first();

    $departmentEmails = [
        // Colleges
        'Institute of Graduate and Advanced Studies' => 'gabriellodavid47@gmail.com',
        'College of Law' => 'gabriellodavid47@gmail.com',
        'College of Pharmacy' => 'gabriellodavid47@gmail.com',
        'College of Human Sciences' => 'gabriellodavid47@gmail.com',
        'College of Teacher Education' => 'gabriellodavid47@gmail.com',
        'College of Business Management and Accountancy' => 'gabriellodavid47@gmail.com',
        'College of Health Sciences' => 'gabriellodavid47@gmail.com',
        'College of Hospitality and Tourism Management' => 'gabriellodavid47@gmail.com',
        'College of Engineering and Architecture' => 'gabriellodavid47@gmail.com',
        'College of Criminal Justice Education' => 'gabriellodavid47@gmail.com',
        'College of Arts and Sciences' => 'gabriellodavid47@gmail.com',
        'College of Information and Technology Education' => 'gabriellodavid47@gmail.com',

        // Departments
        'Center for Student Leadership and Development' => 'gabriellodavid47@gmail.com',
        'Center for Research and Development' => 'gabriellodavid47@gmail.com',
        'Office of the External Affairs and Linkages' => 'gabriellodavid47@gmail.com',
        'Psychological Assessment and Counseling Center' => 'gabriellodavid47@gmail.com',
        'Institutional Planning and Development' => 'gabriellodavid47@gmail.com',
        'Disaster Risk Reduction and Management Office' => 'gabriellodavid47@gmail.com',
        'Center for Community Development and Extension Services' => 'gabriellodavid47@gmail.com',
        'School of Midwifery (CHS)' => 'gabriellodavid47@gmail.com',
        'Center for Training and Professional Development' => 'gabriellodavid47@gmail.com',
        'Research Ethics Committee' => 'gabriellodavid47@gmail.com',
        'University Registrar' => 'gabriellodavid47@gmail.com',
        'Accounting Office' => 'gabriellodavid47@gmail.com',
        'Human Capital Management Office' => 'gabriellodavid47@gmail.com',
        'University Library' => 'gabriellodavid47@gmail.com',
        'Technical Vocational Institute' => 'gabriellodavid47@gmail.com',
        'Security Management Office' => 'gabriellodavid47@gmail.com',
        'Events Management Office' => 'gabriellodavid47@gmail.com',
        'Records Management System' => 'gabriellodavid47@gmail.com',
        'NSTP Department' => 'gabriellodavid47@gmail.com',
        'Management Information Systems' => 'gabriellodavid47@gmail.com',
        'Maintenance and General Services' => 'gabriellodavid47@gmail.com',
        'University Cashier' => 'gabriellodavid47@gmail.com',
        'Gender and Development' => 'gabriellodavid47@gmail.com',
        'Audit Office' => 'gabriellodavid47@gmail.com',
        'Engineering Management & Auxiliary Services' => 'gabriellodavid47@gmail.com',
        'Committee for Publication and Communication Affairs' => 'gabriellodavid47@gmail.com',
        'University Chaplain' => 'gabriellodavid47@gmail.com',
        'University Clinic' => 'gabriellodavid47@gmail.com',
        'University Nurse' => 'gabriellodavid47@gmail.com',
    ];

    if (isset($departmentEmails[$visitor->person_to_visit])) {
        $departmentEmail = $departmentEmails[$visitor->person_to_visit];
        Mail::to($departmentEmail)->queue(new DepartmentNotification($visitor, $departmentEmail));
    }

    // if($visitor){
    return response()->json(['status' => 'success', 'message' => 'Visitor added successfully', 'visitor' => $visitor, 'latestVisitor' => $latestVisitor]);
        // }else{
    //     return response()->json([
    //        'status' => 'error', 'message' => 'Failed to add Visitor '
    //     ]);
    // }

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
    $validatedData = Validator::make($request->all(), [
        'first_name' => 'required|alpha|max:50',
        'middle_name' => 'nullable|alpha|max:1',
        'last_name' => 'required|alpha|max:50',
        'person_to_visit' => 'required|string|max:100',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:30',
        'entry_count' => 'required|integer|min:1',
    ],
    [
        'first_name.alpha' => 'Must no number or syntax.',
        'first_name.max' => 'Reached maximum 50 letters.',
        'middle_name.max' => 'Only 1 letter needed.',
        'last_name.alpha' => 'Must no number or syntax.',
        'last_name.max' => 'Reached maximum 50 letters.',
        'person_to_visit.string' => 'Must no number or syntax.',
        'person_to_visit.max' => 'Must below 100 letters',
        'purpose.string' => 'Must no number or syntax.',
        'purpose.max' => 'Must below 255 letters.',
        'id_type.string' => 'Must no number or syntax.',
        'id_type.max' => 'Must be below 30 letters.',
    ]);

    if ($validatedData->fails()) {
        return response()->json(['errors' => $validatedData->errors()], 422);
    }

    $visitor = Visitor::findOrFail($id);
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
    $visitor->time_out = now()->format('H:i:s');
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
    ]
);

    $visitor = new Visitor();
    $visitor->first_name = $request->first_name;
    $visitor->middle_name = $request->middle_name;
    $visitor->last_name = $request->last_name;
    $visitor->person_to_visit = $request->person_to_visit;
    $visitor->purpose = $request->purpose;
    $visitor->id_type = $request->id_type;
    $visitor->date = now()->format('Y-m-d H:i:s');
    $visitor->time_in = now()->format('H:i:s');
    $visitor->user_id = Auth::id();

    $visitor->save();

    $departmentEmails = [
        // Colleges
        'Institute of Graduate and Advanced Studies' => 'gabriellodavid47@gmail.com',
        'College of Law' => 'gabriellodavid47@gmail.com',
        'College of Pharmacy' => 'gabriellodavid47@gmail.com',
        'College of Human Sciences' => 'gabriellodavid47@gmail.com',
        'College of Teacher Education' => 'gabriellodavid47@gmail.com',
        'College of Business Management and Accountancy' => 'gabriellodavid47@gmail.com',
        'College of Health Sciences' => 'gabriellodavid47@gmail.com',
        'College of Hospitality and Tourism Management' => 'gabriellodavid47@gmail.com',
        'College of Engineering and Architecture' => 'gabriellodavid47@gmail.com',
        'College of Criminal Justice Education' => 'gabriellodavid47@gmail.com',
        'College of Arts and Sciences' => 'gabriellodavid47@gmail.com',
        'College of Information and Technology Education' => 'gabriellodavid47@gmail.com',

        // Departments
        'Center for Student Leadership and Development' => 'gabriellodavid47@gmail.com',
        'Center for Research and Development' => 'gabriellodavid47@gmail.com',
        'Office of the External Affairs and Linkages' => 'gabriellodavid47@gmail.com',
        'Psychological Assessment and Counseling Center' => 'gabriellodavid47@gmail.com',
        'Institutional Planning and Development' => 'gabriellodavid47@gmail.com',
        'Disaster Risk Reduction and Management Office' => 'gabriellodavid47@gmail.com',
        'Center for Community Development and Extension Services' => 'gabriellodavid47@gmail.com',
        'School of Midwifery (CHS)' => 'gabriellodavid47@gmail.com',
        'Center for Training and Professional Development' => 'gabriellodavid47@gmail.com',
        'Research Ethics Committee' => 'gabriellodavid47@gmail.com',
        'University Registrar' => 'gabriellodavid47@gmail.com',
        'Accounting Office' => 'gabriellodavid47@gmail.com',
        'Human Capital Management Office' => 'gabriellodavid47@gmail.com',
        'University Library' => 'gabriellodavid47@gmail.com',
        'Technical Vocational Institute' => 'gabriellodavid47@gmail.com',
        'Security Management Office' => 'gabriellodavid47@gmail.com',
        'Events Management Office' => 'gabriellodavid47@gmail.com',
        'Records Management System' => 'gabriellodavid47@gmail.com',
        'NSTP Department' => 'gabriellodavid47@gmail.com',
        'Management Information Systems' => 'gabriellodavid47@gmail.com',
        'Maintenance and General Services' => 'gabriellodavid47@gmail.com',
        'University Cashier' => 'gabriellodavid47@gmail.com',
        'Gender and Development' => 'gabriellodavid47@gmail.com',
        'Audit Office' => 'gabriellodavid47@gmail.com',
        'Engineering Management & Auxiliary Services' => 'gabriellodavid47@gmail.com',
        'Committee for Publication and Communication Affairs' => 'gabriellodavid47@gmail.com',
        'University Chaplain' => 'gabriellodavid47@gmail.com',
        'University Clinic' => 'gabriellodavid47@gmail.com',
        'University Nurse' => 'gabriellodavid47@gmail.com',
    ];

    if (isset($departmentEmails[$visitor->person_to_visit])) {
        $departmentEmail = $departmentEmails[$visitor->person_to_visit];

        Mail::to($departmentEmail)->queue(new DepartmentNotification($visitor, $departmentEmail));


    }

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
    $visitor->time_out = now()->format('g:i A');
    $visitor->save();

    return redirect()->route('visitors.subadmin');
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
        'first_name' => 'required|alpha|max:50',
        'middle_name' => 'nullable|alpha|max:1',
        'last_name' => 'required|alpha|max:50',
        'person_to_visit' => 'required|string|max:100',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:30',
    ],
    [
        'first_name.alpha' => 'Must no number or syntax.',
        'first_name.max' => 'Reached maximum 50 letters.',
        'middle_name.max' => 'Only 1 letter needed.',
        'last_name.alpha' => 'Must no number or syntax.',
        'last_name.max' => 'Reached maximum 50 letters.',
        'person_to_visit.string' => 'Must no number or syntax.',
        'person_to_visit.max' => 'Must below 100 letters',
        'purpose.string' => 'Must no number or syntax.',
        'purpose.max' => 'Must below 255 letters.',
        'id_type.string' => 'Must no number or syntax.',
        'id_type.max' => 'Must be below 30 letters.',
    ]);

    if ($validatedData->fails()) {
        return response()->json(['errors' => $validatedData->errors()], 422);
    }

    $visitor = Visitor::findOrFail($id);
    $visitor->update($request->all());


    return response()->json([
        'success' => true,
        'message' => 'Visitor updated successfully.'
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
