<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        return view('admin.plans.index');
    }
}
