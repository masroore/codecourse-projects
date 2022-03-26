<?php

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'referrals', 'namespace' => 'Referrals'], function () {
    Route::get('/', 'ReferralController@index')->name('referrals');
    Route::post('/', 'ReferralController@store');
});

Route::group(['prefix' => 'subscriptions', 'namespace' => 'Subscriptions'], function () {
    Route::get('/', 'SubscriptionController@index')->name('subscriptions');
    Route::post('/', 'SubscriptionController@store');
});
