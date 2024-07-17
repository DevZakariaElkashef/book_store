<?php


namespace App\Services;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Setting;

class OrderService
{
    public function createOrder($user, $isBankTransfer, $request)
    {
        $cart = $user->cart;
        $subTotal = Cart::totalCart($user->id);
        $discountAmount = 0;

        if ($cart->coupon) {
            $discountRate = $cart->coupon->discount / 100;
        } else {
            $discountRate = 0;
        }

        $shipping = $request->shipping ?? 0;
        $taxRate = Setting::first()->tax / 100;
        $taxAmount = $subTotal * $taxRate;

        $totalBeforeDiscount = $subTotal + $shipping + $taxAmount;
        $discountAmount = $totalBeforeDiscount * $discountRate;

        $total = $totalBeforeDiscount - $discountAmount;

        $order = Order::create([
            'user_id' => $user->id,
            'coupon_id' => $cart->coupon_id,
            'city_id' => $request->city_id,
            'order_status_id' => 1,
            'shipping' => $shipping,
            'sub_total' => $subTotal,
            'tax' => $taxAmount,
            'discount' => $discountAmount,
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
                'price' =>  hasOffer($item->book_id) ? \App\Models\Book::find($item->book_id)->offer : \App\Models\Book::find($item->book_id)->price,
            ]);

            $book = Book::find($item->book_id);
            $book->update(['qty' => $book->qty - $item->qty]);
        }

        return ['order' => $order, 'total' => $total];
    }
}
