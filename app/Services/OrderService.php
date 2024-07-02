<?php


namespace App\Services;

use App\Models\Order;
use App\Models\Cart;

class OrderService
{
    public function createOrder($user, $isBankTransfer, $request)
    {
        $cart = $user->cart;
        $subTotal = Cart::totalCart($user->id);
        $discount = 0;
        if ($cart->coupon) {
            $discount = $cart->coupon->discount / 100;
        }

        $total = $subTotal - ($subTotal * $discount);
        $order = Order::create([
            'user_id' => $user->id,
            'coupon_id' => $cart->coupon_id,
            'city_id' => $request->city_id,
            'order_status_id' => 1,
            'shipping' => 0,
            'sub_total' => $subTotal,
            'total' => $total,
            'payment_method' => $isBankTransfer,
            'payment_status' => $isBankTransfer ? 0 : 2,
            'transaction_id' => rand(1111111, 9999999),
            'lat' => $request->lat,
            'lng' => $request->lng,
            'transaction_image' => $request->hasFile('transfer_image') ? uploadeImage($request->transfer_image, 'Orders') : null,
            'address' => $request->address,
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'book_id' => $item->book_id,
                'user_id' => $user->id,
                'qty' => $item->qty,
            ]);
        }

        return ['order' => $order, 'total' => $total];
    }
}
