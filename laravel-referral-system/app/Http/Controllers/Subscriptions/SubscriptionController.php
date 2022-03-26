<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscriptions.index');
    }

    public function store(Request $request)
    {
        if ($referral = $request->referral(request()->cookie('referral'))) {
            $referral->complete();
        }

        return redirect()->route('home');
    }
}
