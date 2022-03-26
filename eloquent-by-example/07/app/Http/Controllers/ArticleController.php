<?php

namespace App\Http\Controllers;

use App\Article;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }
}
