<?php

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('projects', 'Tenant\ProjectController');

Route::resource('projects/{project}/files', 'Tenant\ProjectFileController', [
    'names' => [
        'store' => 'projects.files.store',
    ],
]);
