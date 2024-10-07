<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViolationController extends Controller
{
    public function violationView(Request $request)
{
    // Initial query for violations
    $query = Violation::query();

    // Apply date filters if provided
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    // Select latest violation per student
    $violations = Violation::select('violations.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM violations GROUP BY student_no) as latest'), 'violations.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $subQuery->whereDate('violations.created_at', '>=', $request->start_date)
                         ->whereDate('violations.created_at', '<=', $request->end_date);
            }
        })
        ->orderBy('violations.created_at', 'desc')->get();

    $allViolations = $query->get()->groupBy('student_no');

    return view('admin.violation.violation', compact('violations', 'allViolations'));
}



public function store_violation(Request $request)
{
    $request->validate([
        'student_no' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_initial' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'violation_type' => 'required|string|max:255',
        'date' => 'required|date',
    ]);

    $data = [
        'user_id' => Auth::id(),
        'student_no' => $request->student_no,
        'first_name' => $request->first_name,
        'middle_initial' => $request->middle_initial,
        'last_name' => $request->last_name,
        'course' => $request->course,
        'violation_type' => $request->violation_type,
        'date' => $request->date,
    ];



    Violation::create($data);

    return response()->json([
        'status' => 'success'
    ]);
}

public function destroy_violation(string $id)
{
    $violations = Violation::findOrFail($id);

    $violations->delete();

    return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
}

public function update_violationAdmin(Request $request, string $id)
{

    $violations = Violation::findOrFail($id);

    $violations->update($request->all());


    return redirect()->back()->with('success', 'Violation updated successfully');
}


public function violation(Request $request)
{
 return $this->filterViolation($request);
}

public function filterViolation(Request $request)
{
    $query = Violation::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }


    // Select latest violation per student
    $violations = Violation::select('violations.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM violations GROUP BY student_no) as latest'), 'violations.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($request) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $subQuery->whereDate('violations.created_at', '>=', $request->start_date)
                         ->whereDate('violations.created_at', '<=', $request->end_date);
            }
        })
        ->latest()
        ->paginate();

    $allViolations = $query->get()->groupBy('student_no');

    return view('sub-admin.violation.violation', compact('violations', 'allViolations'));
}


public function store_violate(Request $request)
{
    $request->validate([
        'student_no' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_initial' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'violation_type' => 'required|string|max:255',
        'date' => 'required|date',
    ]);

    $data = [
        'user_id' => Auth::id(),
        'student_no' => $request->student_no,
        'first_name' => $request->first_name,
        'middle_initial' => $request->middle_initial,
        'last_name' => $request->last_name,
        'course' => $request->course,
        'violation_type' => $request->violation_type,
        'date' => $request->date,
    ];



    Violation::create($data);

    return response()->json([
        'status' => 'success'
    ]);
}

public function update_violation(Request $request, string $id)
{

    $violations = Violation::findOrFail($id);

    $violations->update($request->all());


    return redirect()->back()->with('success', 'Violation updated successfully');


}
}
