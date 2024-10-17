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

class VisitorController extends Controller
{
    public function index(Request $request)
{
    return $this->filterVisitorAdmin($request);
}

public function filterVisitorAdmin(Request $request)
{
    $query = Visitor::select('visitors.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date) as latest'), 'visitors.id', '=', 'latest.id')
        ->latest();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('visitors.created_at', '>=', $request->start_date)
              ->whereDate('visitors.created_at', '<=', $request->end_date);
    }

    $latestVisitors = $query->get();

    $allVisitors = Visitor::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $allVisitors->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date);
    }

    $allVisitors = $allVisitors->get();

    return view('admin.visitors.visitor_admin', compact('latestVisitors', 'allVisitors'));
}



public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'person_to_visit' => 'required|string|max:255',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:255',
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
public function update(Request $request)
{
    $request->validate([
        'entries.*.id' => 'required|exists:visitors,id',
        'entries.*.first_name' => 'required|string|max:255',
        'entries.*.middle_name' => 'nullable|string|max:255',
        'entries.*.last_name' => 'required|string|max:255',
        'entries.*.person_to_visit' => 'required|string|max:255',
        'entries.*.purpose' => 'required|string|max:255',
        'entries.*.id_type' => 'required|string|max:255',
        'entries.*.entry_count' => 'required|integer',
    ]);

    foreach ($request->entries as $entry) {
        $visitor = Visitor::findOrFail($entry['id']);
        $visitor->update([
            'first_name' => $entry['first_name'],
            'middle_name' => $entry['middle_name'],
            'last_name' => $entry['last_name'],
            'person_to_visit' => $entry['person_to_visit'],
            'purpose' => $entry['purpose'],
            'id_type' => $entry['id_type'],
            'entry_count' => $entry['entry_count'],
        ]);
    }

    return redirect()->back()->with('success', 'Visitor entries updated successfully.');
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
    $query = Visitor::query();
    $user = Auth::user();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    $latestVisitors = Visitor::select('visitors.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM visitors GROUP BY last_name, first_name, middle_name, date) as latest'), 'visitors.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $subQuery->whereDate('visitors.created_at', '>=', $request->start_date)
                         ->whereDate('visitors.created_at', '<=', $request->end_date);
            }
        })
        ->latest()
        ->get();

    $allVisitors = $query->get();

    return view('sub-admin.visitors.visitor', compact('latestVisitors', 'allVisitors', 'request', 'user'));
}



public function store_visit(Request $request)
{
        $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'person_to_visit' => 'required|string|max:255',
        'purpose' => 'required|string|max:255',
        'id_type' => 'required|string|max:255',
    ]);

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

    return response()->json([
        'status' => 'success'
    ]);
}

public function checkout($id)
{
    $visitor = Visitor::findOrFail($id);
    $visitor->time_out = now()->format('H:i:s');
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

    $visitors = Visitor::findOrFail($id);

    $visitors->update($request->all());


    return redirect()->back()->with('success', 'Visitor updated successfully');
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

}
