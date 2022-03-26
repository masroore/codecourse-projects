<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);

Route::group(['prefix' => 'image'], function () {
    Route::get('/{name}', [
        'as' => 'image.index',
        'uses' => 'ImageController@index',
    ]);

    Route::post('/', [
        'as' => 'image.create',
        'uses' => 'ImageController@create',
    ]);
});
