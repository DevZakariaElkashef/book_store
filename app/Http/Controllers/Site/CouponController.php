<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CheckCoupon;
use App\Models\Coupon;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function check(CheckCoupon $request)
    {
        $user = $request->user();

        $cart = $user->cart;

        $coupon = Coupon::where('code', $request->code)->first();

        if (UserCoupon::where('user_id', $user->id)->where('coupon_id', $coupon->id)->exists()) {
            session()->flash("message", [
                'status' => false,
                'content' => __('Coupon Used before')
            ]);

            return redirect()->back();
        }

        $cart->update([
            'coupon_id' => $coupon->id,
        ]);

        UserCoupon::create([
            'user_id' => $user->id,
            'coupon_id' => $coupon->id
        ]);

        session()->flash("message", [
            'status' => true,
            'content' => __('Coupon Added success')
        ]);


        return redirect()->back();
    }
}
