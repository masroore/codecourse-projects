<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = cache()->remember('projects', 10, function () {
            return Project::get();
        });

        return view('tenant.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('tenant.projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Project::create([
            'name' => $request->name,
        ]);

        cache()->forget('projects');

        return back();
    }
}
