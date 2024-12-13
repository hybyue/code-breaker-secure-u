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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:1',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,male,female',
            'employment_type' => 'required|string|in:Teaching,Non-Teaching',
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
            'emergency_contact_name' => 'required|string|max:255',
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
            'first_name.string' => 'The first name must contain only letters and spaces.',
            'middle_name.string' => 'The middle initial must contain only letters and spaces.',
            'middle_name.max' => 'Must only have 1 letter.',
            'last_name.string' => 'The last name must contain only letters and spaces.',
            'contact_no.regex' => 'The contact number format is invalid.',
            'date_birth.before' => 'You must be at least 18 years old.',
            'id_number.unique' => 'This ID number is already taken.',
            'emergency_contact_name.string' => 'The emergency contact name must contain only letters and spaces.',
            'emergency_contact_number.regex' => 'The emergency con   tact number format is invalid.',
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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:1',
            'last_name' => 'required|string|max:255',
            'employment_type' => 'required|string|in:Teaching,Non-Teaching',
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
            'emergency_contact_name' => 'required|string|max:255',
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
            'first_name.string' => 'The first name must contain only letters and spaces.',
            'middle_name.string' => 'Must contain only letters.',
            'middle_name.max' => 'Must only have 1 letter.',
            'last_name.string' => 'The last name must contain only letters and spaces.',
            'contact_no.regex' => 'The contact number format is invalid.',
            'date_birth.before' => 'You must be at least 18 years old.',
            'id_number.unique' => 'This ID number is already taken.',
            'emergency_contact_name.string' => 'The emergency contact name must contain only letters and spaces.',
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
