<?php

namespace App\Services;

use App\Models\Book;

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

        if (isset($data['client_received_refund']) &&  !$order->admin_approve_to_cancle) {
            $order->update([
                'client_received_refund' => 1
            ]);

            $user->update(['wallet' => $user->wallet + $order->total]);
        }

        $refundCondition = $order->payment_status != __('Refunded') && $order->payment_status != 5;
        $revertRefundCondition = $order->payment_status == __('Refunded') && $order->order_status_id == 5;

        if (isset($data['payment_status']) && $data['payment_status'] == 3 && $refundCondition) {
            $order->update([
                'payment_status' => 3,
                'order_status_id' => 5,
                'admin_approve_to_cancle' => 1
            ]);

            foreach ($order->items as $item) {
                $book = Book::find($item->book_id);
                $book->update(['qty' => $book->qty + $item->qty]);
            }
        }

        if (isset($data['order_status_id']) && $data['order_status_id'] == 5 && $refundCondition) {
            $order->update([
                'payment_status' => 3,
                'order_status_id' => 5,
                'admin_approve_to_cancle' => 1
            ]);

            foreach ($order->items as $item) {
                $book = Book::find($item->book_id);
                $book->update(['qty' => $book->qty + $item->qty]);
            }
        }

        if (isset($data['payment_status']) && $data['payment_status'] == 1 && $revertRefundCondition) {
            $order->update([
                'payment_status' => 1,
                'order_status_id' => 4
            ]);

            foreach ($order->items as $item) {
                $book = Book::find($item->book_id);
                $book->update(['qty' => $book->qty - $item->qty]);
            }
        }

        if (isset($data['order_status_id']) && $data['order_status_id'] == 4 && $revertRefundCondition) {
            $order->update([
                'payment_status' => 1,
                'order_status_id' => 4
            ]);

            foreach ($order->items as $item) {
                $book = Book::find($item->book_id);
                $book->update(['qty' => $book->qty - $item->qty]);
            }
        }

        $order->update($data);


        return $order;
    }
}
