<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::get();

        return view('tenant.home', compact('projects'));
    }
}
