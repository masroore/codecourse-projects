<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Transformers\SectionTransformer;

class SectionController extends Controller
{
    public function index(Section $section)
    {
        return fractal()
            ->collection($section->get())
            ->transformWith(new SectionTransformer())
            ->toArray();
    }
}
