<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('comments', 'Comments\CommentController');
Route::resource('comments/{comment}/replies', 'Comments\CommentReplyController');

Route::resource('courses', 'CourseController');

Route::resource('courses/{course}/comments', 'Courses\CourseCommentController', [
    'names' => [
        'index' => 'course.comments.index',
    ],
]);
