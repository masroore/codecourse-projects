<?php

Route::resource('admin/users', 'Admin\UserController');
Route::resource('admin/plans', 'Admin\PlanController');

// DataTable controllers
Route::resource('datatable/users', 'DataTable\UserController');
Route::resource('datatable/plans', 'DataTable\PlanController');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
