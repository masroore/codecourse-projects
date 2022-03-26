<?php

Route::group(['middleware' => ['api']], function () {
    Route::post('/auth/signup', [
        'uses' => 'AuthController@signup',
    ]);

    Route::post('/auth/signin', [
        'uses' => 'AuthController@signin',
    ]);

    Route::get('/sections', [
        'uses' => 'Forum\SectionController@index',
    ]);

    Route::get('topic', [
        'uses' => 'Forum\TopicController@index',
    ]);

    Route::get('topic/{topic}', [
        'uses' => 'Forum\TopicController@show',
    ]);

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/user', [
            'uses' => 'UserController@index',
        ]);

        Route::post('topic', [
            'uses' => 'Forum\TopicController@store',
        ]);

        Route::post('topic/{topic}/post', [
            'uses' => 'Forum\PostController@store',
        ]);
    });
});
