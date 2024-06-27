<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use App\Models\Slider;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ConfirmCodeRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterRequest;
use App\Http\Requests\Site\SendCodeRequest;

class AuthController extends Controller
{
    public function loginPage()
    {
         $loginImg = Slider::where('key', 'login-section')->first()->image;
        return view('site.auth.login', compact('loginImg'));
    }

    public function registerPage()
    {
        $registerImg = Slider::where('key', 'register-section')->first()->image;
        return view('site.auth.register', compact('registerImg'));
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        Auth::login($user);

        return to_route('site.home');
    }


    public function forgetPassword()
    {
        $forgetPasswordImg = Slider::where('key', 'forget_password-section')->first()->image;
        return view('site.auth.forgetpassword', compact('forgetPasswordImg'));
    }

    public function checkCode(Request $request)
    {
        if (!$request->filled('email')) {
            abort(404);
        }

        $img = Slider::where('key', 'otp-section')->first()->image;

        return view("site.auth.check_otp", compact('img'));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->except('avatar');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = uploadeImage($request->avatar, "Users");
        }

        $user = User::create($data);

        Auth::login($user);

        return to_route("site.home");
    }

    public function sendCode(SendCodeRequest $request)
    {
        $user = User::where("email", $request->email)->firstOrFail();

        $otp = rand(1111, 9999);

        $user->update(['otp' => $otp]);

        $user->notify(new SendOtpNotification($user, $otp));

        session()->flash("message", [
            'status' => true,
            'content' => __("checkout success")
        ]);

        return redirect()->back();
    }


    public function confirmCode(ConfirmCodeRequest $request)
    {
        // check if otp for email
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return to_route("site.home");
    }
}
