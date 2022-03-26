<?php

Route::get('/', [
    'as' => 'home',
    'uses' => 'PostsController@index',
]);

Route::get('/post/{post}', [
    'as' => 'post.show',
    'uses' => 'PostController@show',
]);

Route::get('/posts/{tag}', [
    'as' => 'posts.tagged',
    'uses' => 'PostsController@tagged',
]);
