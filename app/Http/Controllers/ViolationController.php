<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllStudent;
use App\Models\Student;
use App\Models\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class ViolationController extends Controller
{
    public function violationView(Request $request)
{
    $query = Violation::query();
    $user = Auth::user();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        // Store filter values in session
        session(['violation_admin_filter' => [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]]);

    }

    $filterData = session('violation_admin_filter', [
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    if (!empty($filterData['start_date'])) {
        $query->whereDate('date', '>=', $filterData['start_date']);
    }

    if (!empty($filterData['end_date'])) {
        $query->whereDate('date', '<=', $filterData['end_date']);
    }

    $violations = Violation::select('violations.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM violations GROUP BY student_no) as latest'), 'violations.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($filterData) {
            if (!empty($filterData['start_date'])) {
                $subQuery->whereDate('violations.date', '>=', $filterData['start_date']);
            }
            if (!empty($filterData['end_date'])) {
                $subQuery->whereDate('violations.date', '<=', $filterData['end_date']);
            }
        })
        ->orderBy('violations.created_at', 'desc')->get();

    $allViolations = $query->get()->groupBy('student_no');


    return view('admin.violation.violation', compact('violations', 'allViolations', 'request', 'user'));
}

public function clearViolationFilterAdmin()
{
    session()->forget('violation_admin_filter');
    return redirect()->route('admin.violation.violation');
}

public function store_violation(Request $request)
{
    $request->validate([
        'student_no' => 'required|string|max:255',
        'first_name' => 'required|string|max:100',
        'middle_initial' => 'nullable|string|max:1',
        'last_name' => 'required|string|max:100',
        'course' => 'required|string|max:255',
        'violation_type' => 'required|string|max:100',
        'remarks' => 'nullable|string|max:255'
    ],
    [
        'first_name.max' => 'Reached maximum 100 letters.',
        'middle_initial.max' => 'Reached maximum 1 letter.',
        'last_name.max' => 'Reached maximum 100 letters.',
    ]);

    $data = [
        'user_id' => Auth::id(),
        'student_no' => $request->student_no,
        'first_name' => $request->first_name,
        'middle_initial' => $request->middle_initial,
        'last_name' => $request->last_name,
        'course' => $request->course,
        'violation_type' => $request->violation_type,
        'date' => now(),
    ];



    Violation::create($data);

    return response()->json([
        'status' => 'success',
        'message' => 'Violation Added successfully.'
    ]);
}

public function destroy_violation(string $id)
{
    $violations = Violation::findOrFail($id);

    $violations->delete();

    return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
}

public function update_violation(Request $request, string $id)
{

    $violations = Violation::findOrFail($id);

    $validatedData = Validator::make($request->all(),[
        'student_no' => 'required|string|max:255',
        'first_name' => 'required|regex:/^[A-Za-z- \s]+$/|max:100',
        'middle_initial' => 'nullable|regex:/^[A-Za-z- \s]+$/|max:1',
        'last_name' => 'required|regex:/^[A-Za-z- \s]+$/|max:100',
        'course' => 'required|string|max:255',
        'violation_type' => 'required|string|max:100',
        'remarks' => 'nullable|string|max:255'
    ],
    [
        'first_name.regex' => 'Must not contain numbers or special characters.',
        'first_name.max' => 'Reached maximum 100 letters.',
        'middle_initial.regex' => 'Must not contain numbers or special characters.',
        'middle_initial.max' => 'Reached maximum 1 letter.',
        'last_name.regex' => 'Must not contain numbers or special characters.',
        'last_name.max' => 'Reached maximum 100 letters.',
    ]);

    if ($validatedData->fails()) {
        return response()->json(['errors' => $validatedData->errors()], 422);
    }

    $violations->update($request->all());

    return response()->json([
        'success' => true,
        'message' => 'Violation updated successfully.'
    ]);
}


public function violation(Request $request)
{
 return $this->filterViolation($request);
}

public function filterViolation(Request $request)
{
    $query = Violation::query();
    $user = Auth::user();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        // Store filter values in session
        session(['violation_filter' => [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]]);

    }

    $filterData = session('violation_filter', [
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    if (!empty($filterData['start_date'])) {
        $query->whereDate('date', '>=', $filterData['start_date']);
    }

    if (!empty($filterData['end_date'])) {
        $query->whereDate('date', '<=', $filterData['end_date']);
    }


    $violations = Violation::select('violations.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM violations GROUP BY student_no) as latest'), 'violations.id', '=', 'latest.id')
        ->where(function ($subQuery) use ($filterData) {
            if (!empty($filterData['start_date'])) {
                $subQuery->whereDate('violations.date', '>=', $filterData['start_date']);
            }
            if (!empty($filterData['end_date'])) {
                $subQuery->whereDate('violations.date', '<=', $filterData['end_date']);
            }
        })
        ->latest()
        ->get();

    $allViolations = $query->get()->groupBy('student_no');

    return view('sub-admin.violation.violation', compact('violations', 'allViolations', 'user', 'request'));
}

public function clearViolationFilter()
{
    session()->forget('violation_filter');
    return redirect()->route('sub-admin.violation.violation');
}

// public function searchStudent(Request $request)
//     {
//         try {
//             $query = AllStudent::query();

//             // Check if search term is ID or name
//             if ($request->filled('student_no')) {
//                 $searchTerm = $request->student_no;
//                 $query->where('student_no', $searchTerm)
//                       ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
//                       ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
//             }

//             $students = $query->limit(5)->get();

//             if ($students->count() > 0) {
//                 return response()->json(['success' => true, 'data' => $students]);
//             } else {
//                 return response()->json(['success' => false]);
//             }
//         } catch (Exception $e) {
//             return response()->json(['error' => $e->getMessage()], 500);
//         }
//     }

public function searchStudentSub(Request $request)
{
    $search = $request->input('search');

    $students = Student::where('student_no', 'LIKE', "%{$search}%")
        ->orWhere('first_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->get();

    if ($students->count() > 0) {
        return response()->json([
            'success' => true,
            'students' => $students
        ]);
    } else {
        return response()->json([
            'success' => false,
            'students' => []
        ]);
    }
}


}
