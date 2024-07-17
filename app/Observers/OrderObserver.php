<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $order->timelines()->create([
            'order_status_id' => $order->order_status_id,
            'note' => __('Order was placed (Order ID: #') . $order->status->id . '32543)'
        ]);

        // send notifications
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        $timelines = $order->timelines()->latest()->first();

        if ($timelines->order_status_id != $order->order_status_id) {
            $order->timelines()->create([
                'order_status_id' => $order->order_status_id,
                'note' => __('Order Status Change to') . $order->status->name
            ]);
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
