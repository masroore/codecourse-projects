<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [
    'uses' => 'TaskController@index',
    'as' => 'tasks.index',
]);

Route::post('/task', [
    'uses' => 'TaskController@store',
    'as' => 'tasks.store',
]);

Route::delete('/task/{task}', [
    'uses' => 'TaskController@destroy',
    'as' => 'tasks.destroy',
]);

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');
