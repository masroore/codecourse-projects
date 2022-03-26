<?php

use App\Category;
use App\Product;

Route::get('/', function () {
    $product = Product::find(4);
    $category = Category::find(1);

    $product->categories()->orWherePivot('visible', false)->updateExistingPivot($category->id, [
        'visible' => true,
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/categories/{category}', 'CategoryController@show');
Route::get('/products/{product}', 'ProductController@show');
