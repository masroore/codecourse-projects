<?php

namespace App\Http\Controllers;

class AccountDeletionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['password.confirm']);
    }

    public function index()
    {
        return view('auth.delete');
    }

    public function destroy()
    {
        auth()->user()->delete();

        return redirect()->route('home');
    }
}
