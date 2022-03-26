<?php

namespace App\Http\Controllers;

class TwoFactorController extends Controller
{
    public function __invoke()
    {
        return view('auth.twofactor');
    }
}
