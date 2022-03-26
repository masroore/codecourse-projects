<?php

namespace App\Http\Controllers;

class PasswordController extends Controller
{
    public function __invoke()
    {
        return view('auth.password');
    }
}
