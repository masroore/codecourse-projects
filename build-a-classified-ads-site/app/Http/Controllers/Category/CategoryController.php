<?php

namespace App\Http\Controllers\Category;

use App\Area;
use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Area $area)
    {
        $categories = Category::withListingsInArea($area)->get()->toTree();

        return view('categories.index', compact('categories'));
    }
}
