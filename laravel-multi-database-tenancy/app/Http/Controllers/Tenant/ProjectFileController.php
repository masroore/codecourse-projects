<?php

namespace App\Http\Controllers\Tenant;

use App\File;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    public function store(Project $project, Request $request)
    {
        $upload = $request->file('file');

        if ($path = Storage::disk('tenant')->putFile('/', $upload)) {
            $file = File::make([
                'name' => $upload->getClientOriginalName(),
                'path' => $path,
            ]);

            $project->files()->save($file);
        }

        return back();
    }
}
