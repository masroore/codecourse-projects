<?php

use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/mailing/unsubscribe/{token}', 'Mailing\SubscriptionController@unsubscribe');
