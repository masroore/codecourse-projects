<?php

namespace App\Http\Controllers;

use App\Area;

class HomeController extends Controller
{
    public function index()
    {
        $areas = Area::get()->toTree();

        return view('home', compact('areas'));
    }
}
