<?php

Route::get('/', function (Illuminate\Http\Request $request) {
    $user = $request->user();

    return new \Illuminate\Http\Response('hello', 200);
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'role:admin'], function () {
    Route::group(['middleware' => 'role:admin,delete users'], function () {
        Route::get('/admin/users', function () {
            return 'Delete users in admin panel';
        });
    });

    Route::get('/admin', function () {
        return 'Admin panel';
    });
});
