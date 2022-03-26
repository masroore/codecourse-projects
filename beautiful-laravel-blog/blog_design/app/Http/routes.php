<?php

Route::get('/', function () {
    return view('home');
});

Route::get('/post', function () {
    return view('post/post');
});

Route::get('/posts/coding', function () {
    return view('posts/tag');
});
