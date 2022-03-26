<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = $request->user()->projects()->orderBy('created_at', 'desc')->paginate(10);

        return view('user.projects.index', compact('projects'));
    }
}
