<?php

namespace App\Http\Controllers\Referrals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Referrals\ReferralStoreRequest;
use App\Mail\Referrals\ReferralReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $referrals = $request->user()->referrals()->orderBy('completed', 'asc')->get();

        return view('referrals.index', compact('referrals'));
    }

    public function store(ReferralStoreRequest $request)
    {
        $referral = $request->user()->referrals()->create($request->only('email'));

        Mail::to($referral->email)->send(
            new ReferralReceived($request->user(), $referral)
        );

        return back();
    }
}
