<?php

use App\Post;
use App\Topic;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $topic = Topic::find(5);

    $post = new Post();
    $post->body = 'Reply three';
    $post->user()->associate($request->user());

    $topic->posts()->save($post);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/topics', 'TopicController@index');
Route::get('/topics/{topic}', 'TopicController@show')->name('topics.show');

Route::get('/user/topics', 'UserTopicController@index');
Route::get('/user/posts', 'UserPostController@index');
