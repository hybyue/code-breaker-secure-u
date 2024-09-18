<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllEmployee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function student_admin()
{
    $students = Student::latest()->get();

    return view('admin.students.student', compact('students'));
}
    public function store_student_admin(Request $request)
    {

        $request->validate([
            'student_no' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'course' => 'required|string',
            ]);

            $data = [
                'user_id' => Auth::id(),
               'student_no' => $request->student_no,
               'first_name' => $request->first_name,
               'middle_name' => $request->middle_name,
               'last_name' => $request->last_name,
               'course' => $request->course,
            ];

            Student::create($data);

            return redirect()->back()->with('success', 'Student added successfully');
    }
    public function destroy_student_admin(string $id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return response()->json(['success' => true, 'tr' => 'tr_' . $id]);
    }

    public function all_employee_admin()
    {
        $allEmployees = AllEmployee::all();

        return view('admin.employees.all_employee', compact('allEmployees'));
    }
    public function store_all_employee_admin(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'designation' => 'required|string',
            'department' => 'required|string',
            'status' => 'required|string',
            ]);

            $data = [
                'user_id' => Auth::id(),
                'employee_id' => $request->employee_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'designation' => $request->designation,
                'department' => $request->department,
                'status' => $request->status,
            ];

            AllEmployee::create($data);

            return redirect()->back()->with('success', 'Employee added successfully');
    }

    public function destroy_all_employee_admin(string $id)
    {
        $allEmployee = AllEmployee::findOrFail($id);

        $allEmployee->delete();

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
