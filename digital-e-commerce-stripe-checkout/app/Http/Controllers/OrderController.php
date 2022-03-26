<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('products')->latest()->get();

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }
}
