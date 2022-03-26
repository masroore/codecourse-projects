<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierWebhookController;

class WebhookController extends CashierWebhookController
{
    public function handleCheckoutSessionCompleted($payload)
    {
        if ($user = $this->getUserByStripeId($payload['data']['object']['customer'])) {
            $cart = $user->cart;

            $order = $user->orders()->create();
            $order->products()->attach($cart->products);

            $cart->fresh()->delete();
        }
    }
}
