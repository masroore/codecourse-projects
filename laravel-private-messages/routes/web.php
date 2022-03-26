<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'webapi', 'namespace' => 'Api'], function () {
    Route::get('/conversations', 'ConversationController@index');
    Route::post('/conversations', 'ConversationController@store');
    Route::get('/conversations/{conversation}', 'ConversationController@show');
    Route::post('/conversations/{conversation}/reply', 'ConversationReplyController@store');
    Route::post('/conversations/{conversation}/users', 'ConversationUserController@store');
});

Route::get('/home', 'HomeController@index');

Route::get('/conversations', 'ConversationController@index');
Route::get('/conversations/{conversation}', 'ConversationController@show');
