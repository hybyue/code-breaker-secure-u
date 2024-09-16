<?php

namespace App\Http\Controllers;


use App\Mail\SendPasswordMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function register()
    {
        return view('auth/register');
    }

    public function passwordEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function passwordReset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function registerSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[_!@#$%^&*()<>?]/',
                'confirmed'
            ],
        ], [
            'password.regex' => 'Password is weak. Try including numbers, uppercase and lowercase letters, and symbols (_!@#$%^&*()<>?).',
            'email.unique' => 'The email address is already registered.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "0"
        ]);

        // Send password email
        Mail::to($user->email)->send(new SendPasswordMail($user->name, $request->password));

        return redirect()->route('admin.register')->with('success', 'Account created successfully.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();


        if (Auth::user()->type == 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('sub-admin.dashboard');
        }

        // return redirect()->route('dashboard');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[_!@#$%^&*()<>?]/',
                'confirmed'
            ],
            'new_password_confirmation' => 'required'
        ], [
            'new_password.regex' => 'Password is weak. Try including numbers, uppercase and lowercase letters, and symbols (_!@#$%^&*()<>?).'
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password
        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

         if (Auth::user()->type == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'password change successfully');
        } else {
            return redirect()->route('sub-admin.dashboard')->with('success', 'password change successfully');
        }
    }



public function logout(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    return redirect('/login');
}


}
