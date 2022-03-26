<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()->orderBy('created_at', 'desc')->paginate(10);

        return view('category.show', compact('category', 'products'));
    }
}
