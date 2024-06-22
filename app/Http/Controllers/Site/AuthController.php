<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterRequest;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('site.auth.login');
    }

    public function registerPage()
    {
        return view('site.auth.register');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        Auth::login($user);

        return to_route('site.home');
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

    public function logout(Request $request)
    {
        $user = $request->user();

        Auth::logout($user);

        return to_route("site.home");
    }
}
