<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\loginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetAdminPassword;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendAdminRestPasswordJob;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\SendPasswordEmailRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        $img = Slider::where("key", 'admin-login')->first()->image;
        return view('dashboard.auth.login', compact('img'));
    }

    public function forgetPassword()
    {
        $img = Slider::where("key", 'admin-forget')->first()->image;
        return view('dashboard.auth.forget-password', compact('img'));
    }

    public function resetPasswordPage($token)
    {
        $token = DB::table('password_reset_tokens')->where('token', $token)->first();
        $img = Slider::where("key", 'admin-forget')->first()->image;

        if (!$token) {
            return to_route('dashboard.login')->with('message', __('Token Expire'));
        }

        return view('dashboard.auth.reset-password', compact('token', 'img'));
    }

    public function login(loginRequest $request)
    {
        $credentials = $request->validated();
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            return to_route('dashboard.home');
        } else {
            // Redirect back with an error message
            return redirect()->back()->with('message', __('Invalid credentials provided'));
        }
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        Auth::logout($user);

        return back();
    }

    public function sendEmailPassword(SendPasswordEmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => __("Email Not Found!")]);
        }
        // Generate a unique token for the password reset link
        $token = Str::random(64);

        // Save the token in the password_resets table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['email' => $user->email, 'token' => $token, 'created_at' => now()]
        );

        // Send the reset link email using your preferred email sending method
        SendAdminRestPasswordJob::dispatch($user, $token);

        return back()->with('status', __('A password reset link has been sent to your email address.'));
    }

    public function resetPassword(ResetAdminPassword $request)
    {
        $token = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        $user = User::where('email', $token->email)->first();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return to_route('dashboard.login_page')->with('message', __("Password Reset Successfuly!"));
    }
}
