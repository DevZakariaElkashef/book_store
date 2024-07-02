<?php

namespace App\Http\Controllers\Site;

use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\Site\UpdateLangRequest;
use App\Http\Requests\Site\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $cities = City::active()->get();


        return view('site.profile.index', compact('user', 'cities'));
    }

    public function settings(Request $request)
    {
        $user = $request->user();

        return view('site.profile.settings', compact('user'));
    }

    public function orders(Request $request)
    {
        $user = $request->user();
        $orders = Order::where('user_id', $user->id)->success()->latest()->paginate(3);

        return view('site.profile.orders', compact('user', 'orders'));
    }


    public function showOrder (Request $request, $id)
    {
        $user = $request->user();
        $order = Order::findOrFail($id);

        return view('site.profile.order', compact('user', 'order'));
    }



    public function editPassword(Request $request)
    {
        $user = $request->user();

        $cities = City::active()->get();


        return view('site.profile.edit_password', compact('user', 'cities'));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        $user->update(['password' => $request->new_password]);

        session()->flash("message", [
            'status' => true,
            'content' => __("updated success")
        ]);

        return redirect()->back();
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();

        $data = $request->except('avatar');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = uploadeImage($request->avatar, 'Users');
        }

        $user->update($data);

        session()->flash("message", [
            'status' => true,
            'content' => __("updated success")
        ]);

        return redirect()->back();
    }

    public function lang(UpdateLangRequest $request)
    {
        $language = $request->input('lang');
        Session::put('locale', $language);

        return redirect()->back();
    }
}
