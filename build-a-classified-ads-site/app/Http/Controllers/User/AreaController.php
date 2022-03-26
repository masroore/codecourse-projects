<?php

namespace App\Http\Controllers\User;

use App\Area;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    public function store(Area $area)
    {
        session()->put('area', $area->slug);

        return redirect()->route('category.index', [$area]);
    }
}
