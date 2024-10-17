<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subAdmins = User::where('type', 0)
                         ->with('employ')
                         ->get();
        return view('admin.employee', compact('subAdmins'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_number' => 'required|string|max:255',
    //         'first_name' => 'required|string|max:255',
    //         'middle_name' => 'nullable|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'gender' => 'required|string|max:255',
    //         'civil_status' => 'required|string|max:255',
    //         'contact_no' => 'required|string|max:255',
    //         'date_birth' => 'required|date',
    //         'employment_type' => 'required|string|max:255',
    //     ]);

    //     Employee::create([
    //         'user_id' => Auth::id(),
    //         'id_number' => $request->id_number,
    //         'first_name' => $request->first_name,
    //         'middle_name' => $request->middle_name,
    //         'last_name' => $request->last_name,
    //         'gender' => $request->gender,
    //         'civil_status' => $request->civil_status,
    //         'email_address' => Auth::user()->email,
    //         'contact_no' => $request->contact_no,
    //         'date_birth' => $request->date_birth,
    //         'employment_type' => $request->employment_type,
    //     ]);


    //     return redirect()->route('admin.employee')->with('success', 'Employee created successfully.');
    // }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employees = Employee::findOrFail($id);

        return view('employee.show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employees = Employee::findOrFail($id);

        return view('employee.edit', compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employees = Employee::findOrFail($id);

        $employees->update($request->all());

        return redirect()->route('admin.employee')->with('success', 'employees updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employees = Employee::findOrFail($id);

        $employees->delete();

        return redirect()->route('admin.employee')->with('success', 'product deleted successfully');
    }

    public function showProfile()
    {
        $user = Auth::user();
        $employees = $user->employ;

        return view('profile', compact('user', 'employees'));
    }

    public function addInformation(Request $request)
    {
        $request->validate([
            'id_number' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'civil_status' => 'required|string|max:255',
            'contact_no' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'employment_type' => 'required|string|max:255',
        ]);

        Employee::create([
            'user_id' => Auth::id(),
            'id_number' => $request->id_number,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'email_address' => Auth::user()->email,
            'contact_no' => $request->contact_no,
            'date_birth' => $request->date_birth,
            'employment_type' => $request->employment_type,
        ]);

        return redirect()->route('profile')->with('success', 'Employee created successfully.');
    }

    public function editInformation(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('profile')->with('success', 'Employee updated successfully');
    }

    public function showProfileAdmin()
    {
        $user = Auth::user();
        $employees = $user->employ;

        return view('admin.layouts.profile_admin', compact('user', 'employees'));
    }

    public function addInformationAdmin(Request $request)
    {
        $request->validate([
            'id_number' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'civil_status' => 'required|string|max:255',
            'contact_no' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'employment_type' => 'required|string|max:255',
        ]);

        Employee::create([
            'user_id' => Auth::id(),
            'id_number' => $request->id_number,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'email_address' => Auth::user()->email,
            'contact_no' => $request->contact_no,
            'date_birth' => $request->date_birth,
            'employment_type' => $request->employment_type,
        ]);


        return redirect()->route('admin.layouts.profile_admin')->with('success', 'Employee created successfully.');
    }

    public function editInformationAdmin(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('admin.layouts.profile_admin')->with('success', 'Employee updated successfully');
    }
    public function changePassword()
    {
        $user = Auth::user();
        $employees = $user->employ;

        return view('auth.change-password', compact('user', 'employees'));
    }

    public function changePasswordAdmin()
    {
        $user = Auth::user();
        $employees = $user->employ;

        return view('auth.change-password', compact('user', 'employees'));
    }
}
