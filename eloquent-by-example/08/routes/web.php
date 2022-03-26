<?php

Route::get('/', function () {
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/lessons', 'LessonController@index');
Route::get('/lessons/{lesson}', 'LessonController@show');

Route::get('/tags/{tag}', 'TagController@show')->name('tag.show');
