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
use Illuminate\Support\Facades\RateLimiter as FacadesRateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_ name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[;-|_!@#$%^&*()<>?]/',
                'confirmed'
            ],
        ], [
            'password.regex' => 'Password is weak. Try including numbers, uppercase and lowercase letters, and symbols (;-|_!@#$%^&*()<>?).',
            'email.unique' => 'The email address is already registered.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'type' => "0"
        ]);

        try {
            Mail::to($user->email)
                ->queue(new SendPasswordMail($user->name, $user->email, $request->password));

            return redirect()->route('admin.register')
                ->with('success', 'Account created successfully and email will be sent.');

        } catch (\Exception $e) {
            Log::error('Email Error: ' . $e->getMessage());
            return redirect()->route('admin.register')
                ->with('success', 'Account created successfully.')
                ->with('warning', 'Email will be sent automatically when connection is restored.');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
{
    $this->checkTooManyFailedAttempts($request);
    // Validate input
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // If validation fails, return error as JSON
    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422); // Unprocessable Entity status code
    }

    // Attempt to login
    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        // Check if email exists in the system to provide a more specific message
        if (!User::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email is not registered'
            ], 404); // Not Found
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Incorrect password'
        ], 401); // Unauthorized
    }

    // Regenerate session on successful login
    $request->session()->regenerate();

    activity()
        ->causedBy(Auth::user())
        ->withProperties(['ip' => $request->ip()])
        ->log('logged in');

    // Check if the user is admin or sub-admin
    if (Auth::user()->type == 'admin') {
        return response()->json([
            'status' => 'success',
            'redirect' => route('admin.dashboard')
        ]);
    } else {
        return response()->json([
            'status' => 'success',
            'redirect' => route('sub-admin.dashboard')
        ]);
    }
}

    // Check for too many failed attempts
    protected function checkTooManyFailedAttempts($request)
    {
        if (FacadesRateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            $seconds = FacadesRateLimiter::availableIn($this->throttleKey($request));

            return response()->json([
                'message' => 'Too many attempts',
                'seconds' => $seconds
            ], 429);
        }
    }

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
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
    $request->session()->regenerateToken();

    if ($request->ajax()) {
        return response()->json(['redirect' => route('login')]);
    }

    return redirect('/login');
}


}
