<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/tenant/{company}', 'TenantController@switch')->name('tenant.switch');

Route::resource('companies', 'CompanyController');
