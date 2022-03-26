<?php

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $article = Article::find(1);

    $comment = new Comment();
    $comment->body = 'A brand new comment on a video';
    $comment->user()->associate($request->user());

    $article->comments()->save($comment);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/articles/{article}', 'ArticleController@show');
Route::get('/videos/{video}', 'VideoController@show');
