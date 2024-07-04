<?php

namespace App\Services;

class OrderUpdateService
{
    public function updateOrder($order, $data)
    {
        $user = $order->user;


        // Update the order totals
        if (isset($data['total'], $data['sub_total'], $data['tax'], $data['discount'], $data['shipping'])) {
            $order->update([
                'total' => $data['total'],
                'sub_total' => $data['sub_total'],
                'tax' => $data['tax'],
                'discount' => $data['discount'],
                'shipping' => $data['shipping']
            ]);
        }

        // Update order items
        if (isset($data['book'], $data['count'])) {
            // Clear existing items
            $order->items()->delete();

            // Add updated items
            for ($i = 0; $i < count($data['book']); $i++) {
                $order->items()->create([
                    'book_id' => $data['book'][$i],
                    'qty' => $data['count'][$i],
                ]);
            }
        }

        $refundCondition = $order->payment_status != 'Refunded' && $order->payment_status != 5;
        $revertRefundCondition = $order->payment_status == 'Refunded' && $order->order_status_id == 5;

        if (isset($data['payment_status']) && $data['payment_status'] == 3 && $refundCondition) {
            $order->update([
                'payment_status' => 3,
                'order_status_id' => 5
            ]);
            $user->update(['wallet' => $user->wallet + $order->total]);
        }

        if (isset($data['order_status_id']) && $data['order_status_id'] == 5 && $refundCondition) {
            $order->update([
                'payment_status' => 3,
                'order_status_id' => 5
            ]);
            $user->update(['wallet' => $user->wallet + $order->total]);
        }

        if (isset($data['payment_status']) && $data['payment_status'] == 1 && $revertRefundCondition) {
            $order->update([
                'payment_status' => 1,
                'order_status_id' => 4
            ]);
            $user->update(['wallet' => $user->wallet - $order->total]);
        }

        if (isset($data['order_status_id']) && $data['order_status_id'] == 4 && $revertRefundCondition) {
            $order->update([
                'payment_status' => 1,
                'order_status_id' => 4
            ]);
            $user->update(['wallet' => $user->wallet - $order->total]);
        }

        return $order;
    }
}
