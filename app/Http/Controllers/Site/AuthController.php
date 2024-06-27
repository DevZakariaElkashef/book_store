<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterRequest;

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

    public function sendCode(Request $request)
    {

    }

    public function logout(Request $request)
    {
        $user = $request->user();

        Auth::logout($user);

        return to_route("site.home");
    }
}
