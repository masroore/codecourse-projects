<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPaid;

class CreateTransaction
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $event->order->transactions()->create([
            'total' => $event->order->total()->amount(),
        ]);
    }
}
