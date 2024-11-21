<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $subAdmins = User::where('type', 0)
                         ->latest()
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
        $securityStaff = User::findOrFail($id);
        $securityStaff->update($request->all());

        return redirect()->route('admin.employee')->with('success', 'Security Staff updated successfully');
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

        return view('profile', compact('user'));
    }

    public function addInformation(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_number' => 'required|string|max:255|unique:users,id_number,' . $id,
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'middle_name' => 'nullable|string|max:1|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'gender' => 'required|string|in:Male,Female,male,female',
            'civil_status' => 'required|string|in:Single,Married,Divorced,Widowed',
            'contact_no' => [
                'required',
                'string',
                'max:11',
                'regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            'date_birth' => [
                'required',
                'date',
                'before:' . now()->subYears(18)->format('Y-m-d')
            ],
            'employment_type' => 'required|string|in:Part-Time,Full-Time,Other',
            'emergency_contact_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'emergency_contact_number' => [
                'required',
                'string',
                'max:11',
                'regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            'date_hired' => 'required|date',
            'badge_number' => 'required|string|max:255|unique:users,badge_number,' . $id,
            'address' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ], [
            'first_name.regex' => 'The first name must contain only letters and spaces.',
            'middle_name.regex' => 'The middle initial must contain only letters and spaces.',
            'middle_name.max' => 'Must only have 1 letter.',
            'last_name.regex' => 'The last name must contain only letters and spaces.',
            'contact_no.regex' => 'The contact number format is invalid.',
            'date_birth.before' => 'You must be at least 18 years old.',
            'id_number.unique' => 'This ID number is already taken.',
            'emergency_contact_name.regex' => 'The emergency contact name must contain only letters and spaces.',
            'emergency_contact_number.regex' => 'The emergency contact number format is invalid.',
            'badge_number.unique' => 'This badge number is already taken.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail($id);


        $user->update($request->all());

        return response()->json([
            'success' => true,
            'user' => $user,
            'message' => 'Profile information updated successfully.'
        ]);
    }

    public function editInformation(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_number' => 'required|string|max:255|unique:users,id_number,' . $id,
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'middle_name' => 'nullable|string|max:1|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'gender' => 'required|string|in:Male,Female,male,female',
            'civil_status' => 'required|string|in:Single,Married,Divorced,Widowed',
            'contact_no' => [
                'required',
                'string',
                'max:11',
                'regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            'date_birth' => [
                'required',
                'date',
                'before:' . now()->subYears(18)->format('Y-m-d')
            ],
            'employment_type' => 'required|string|in:Part-Time,Full-Time,Other',
            'emergency_contact_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'emergency_contact_number' => [
                'required',
                'string',
                'max:11',
                'regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            'date_hired' => 'required|date',
            'badge_number' => 'required|string|max:255|unique:users,badge_number,' . $id,
            'schedule' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ], [
            'first_name.regex' => 'The first name must contain only letters and spaces.',
            'middle_name.regex' => 'Must contain only letters.',
            'middle_name.max' => 'Must only have 1 letter.',
            'last_name.regex' => 'The last name must contain only letters and spaces.',
            'contact_no.regex' => 'The contact number format is invalid.',
            'date_birth.before' => 'You must be at least 18 years old.',
            'id_number.unique' => 'This ID number is already taken.',
            'emergency_contact_name.regex' => 'The emergency contact name must contain only letters and spaces.',
            'emergency_contact_number.regex' => 'The emergency contact number format is invalid.',
            'badge_number.unique' => 'This badge number is already taken.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail($id);

        try {


            $user->update($request->all());

            return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'Staff updated successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating profile: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updatePicture(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('profile_picture')) {


            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $fileName, 'public');
            $user->profile_picture = '/storage/' . $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile picture updated successfully');
    }

    public function updatePictureAdmin(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                unlink(public_path($user->profile_picture));
            }

            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $fileName, 'public');
            $user->profile_picture = '/storage/' . $path;
            $user->save();

            return redirect()->back()->with('success', 'Profile picture updated successfully');
        }

        return redirect()->back()->with('error', 'No image file uploaded');
    }

    public function showProfileAdmin()
    {
        $user = Auth::user();


        return view('admin.layouts.profile_admin', compact('user'));
    }

    public function addInformationAdmin(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_number' => 'required|string|max:255|unique:users,id_number,' . $id,
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'middle_name' => 'nullable|string|max:1|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'gender' => 'required|string|in:Male,Female,male,female',
            'civil_status' => 'required|string|in:Single,Married,Divorced,Widowed',
            'contact_no' => [
                'required',
                'string',
                'max:11',
                'regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            'date_birth' => [
                'required',
                'date',
                'before:' . now()->subYears(18)->format('Y-m-d')
            ],
            'employment_type' => 'required|string|in:Part-Time,Full-Time,Other',
            'emergency_contact_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'emergency_contact_number' => [
                'required',
                'string',
                'max:11',
                'regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            'date_hired' => 'required|date',
            'badge_number' => 'required|string|max:255|unique:users,badge_number,' . $id,
            'schedule' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'street' => 'required|string|max:255',
        ], [
            'first_name.regex' => 'The first name must contain only letters and spaces.',
            'middle_name.regex' => 'Must contain only letters and spaces.',
            'middle_name.max' => 'Must only have 1 letter.',
            'last_name.regex' => 'The last name must contain only letters and spaces.',
            'contact_no.regex' => 'The contact number format is invalid.',
            'date_birth.before' => 'You must be at least 18 years old.',
            'id_number.unique' => 'This ID number is already taken.',
            'emergency_contact_name.regex' => 'The emergency contact name must contain only letters and spaces.',
            'emergency_contact_number.regex' => 'The emergency contact number format is invalid.',
            'badge_number.unique' => 'This badge number is already taken.',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'street' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail($id);

        // Get the form data
        $userData = $request->all();

        // Use the text values for address fields
        $userData['province'] = $request->input('province_text');
        $userData['municipality'] = $request->input('municipality_text');
        $userData['barangay'] = $request->input('barangay_text');

        $user->update($userData);

        return response()->json([
            'success' => true,
            'user' => $user,
            'message' => 'Profile information updated successfully.'
        ]);
    }

    public function editInformationAdmin(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_number' => 'required|string|max:255|unique:users,id_number,' . $id,
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'middle_name' => 'nullable|string|max:1|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'gender' => 'required|string|in:Male,Female,male,female',
            'civil_status' => 'required|string|in:Single,Married,Divorced,Widowed',
            'contact_no' => [
                'required',
                'string',
                'max:11',
                'regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            'date_birth' => [
                'required',
                'date',
                'before:' . now()->subYears(18)->format('Y-m-d')
            ],
            'employment_type' => 'required|string|in:Part-Time,Full-Time,Other',
            'emergency_contact_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'emergency_contact_number' => [
                'required',
                'string',
                'max:11',
                'regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            'date_hired' => 'required|date',
            'badge_number' => 'required|string|max:255|unique:users,badge_number,' . $id,
            'schedule' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'street' => 'required|string|max:255',
        ], [
            'first_name.regex' => 'The first name must contain only letters and spaces.',
            'middle_name.regex' => 'Must contain only letters and spaces.',
            'middle_name.max' => 'Must only have 1 letter.',
            'last_name.regex' => 'The last name must contain only letters and spaces.',
            'contact_no.regex' => 'The contact number format is invalid.',
            'date_birth.before' => 'You must be at least 18 years old.',
            'id_number.unique' => 'This ID number is already taken.',
            'emergency_contact_name.regex' => 'The emergency contact name must contain only letters and spaces.',
            'emergency_contact_number.regex' => 'The emergency contact number format is invalid.',
            'badge_number.unique' => 'This badge number is already taken.',
            'street.required' => 'The street address is required.',
            'province.required' => 'The province field is required.',
            'municipality.required' => 'The municipality field is required.',
            'barangay.required' => 'The barangay field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json([
            'success' => true,
            'user' => $user,
            'message' => 'Staff updated successfully'
        ]);
    }
    public function changePassword()
    {
        $user = Auth::user();

        return view('auth.change-password', compact('user'));
    }

    public function changePasswordAdmin()
    {
        $user = Auth::user();

        return view('auth.change-password', compact('user'));
    }
}
