<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateProfileRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cities = City::active()->get();

        return view("dashboard.pages.profile.index", compact('user', 'cities'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $data = $request->except('avatar');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = uploadeImage($request->avatar, 'Users', $user->avatar);
        }

        $user->update($data);

        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return back()->with('message', $message);
    }
}
