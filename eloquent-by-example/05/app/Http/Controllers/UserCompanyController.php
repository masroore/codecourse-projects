<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $companies = $request->user()->companies()->get();

        return view('user.companies.index', compact('companies'));
    }
}
