<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:airlock']], function () {
    Route::get('/repo/invites', 'Api\Repo\RepoInviteController@index');
    Route::post('/repo/invites', 'Api\Repo\RepoInviteController@store');
});
