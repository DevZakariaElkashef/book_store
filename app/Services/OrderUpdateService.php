<?php

namespace App\Services;

use App\Models\Order;

class OrderUpdateService
{
    public function updateOrder($order, $data)
    {
        // Get the original statuses and other necessary data
        $originalOrderStatus = $order->order_status_id;
        $originalPaymentStatus = $order->payment_status;
        $amount = $order->total;
        $user = $order->user;

        // Determine new statuses from data or keep originals if not provided
        $newOrderStatus = $data['order_status_id'] ?? $originalOrderStatus;
        $newPaymentStatus = $data['payment_status'] ?? $originalPaymentStatus;

        // Handle order status change
        if ($originalOrderStatus != 5 && $newOrderStatus == 5) {
            // Change from any status to 'Canceled' (5)
            $user->update(['wallet' => $user->wallet + $amount]);
            $newPaymentStatus = 'Refunded'; // Set payment status to 'Refunded'
        } elseif ($originalOrderStatus == 5 && $newOrderStatus != 5) {
            // Change from 'Canceled' (5) to any other status
            $user->update(['wallet' => $user->wallet - $amount]);
        }

        // Handle payment status change
        if ($originalPaymentStatus != 'Refunded' && $newPaymentStatus == 'Refunded') {
            // Change from any status to 'Refunded'
            $user->update(['wallet' => $user->wallet + $amount]);
            $newOrderStatus = 5; // Set order status to 'Canceled' (5)
        } elseif ($originalPaymentStatus == 'Refunded' && $newPaymentStatus != 'Refunded') {
            // Change from 'Refunded' to any other status
            $user->update(['wallet' => $user->wallet - $amount]);
        }

        // If order status is being changed to 'Delivered' (1), update payment status to 'Paid' (1)
        if ($originalOrderStatus != 1 && $newOrderStatus == 1) {
            $newPaymentStatus = 'Paid';
        }

        dd($newPaymentStatus, $newOrderStatus);
        // Update the order with the determined statuses
        $order->update([
            'order_status_id' => $newOrderStatus,
            'payment_status' => $newPaymentStatus,
        ]);

        return $order;
    }
}
