<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/series/{series}/edit', 'SeriesController@edit');
Route::patch('/series/{series}', 'SeriesController@update');
