<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public const SEARCH_INDEX = 'articles.index';

    protected $fillable = [
        'title',
        'body',
    ];
}
