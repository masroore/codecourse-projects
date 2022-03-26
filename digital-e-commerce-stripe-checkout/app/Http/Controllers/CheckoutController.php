<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $cart = Cart::bySession()->first();

        $checkout = $request->user()->checkout($cart->products->pluck('stripe_id')->toArray(), [
            'success_url' => route('orders.index'),
            'cancel_url' => route('cart.index'),
        ]);

        return view('checkout.index', [
            'checkout' => $checkout,
        ]);
    }
}
