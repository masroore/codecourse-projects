<?php

namespace App;

use App\History\Traits\Historyable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Historyable;

    protected $guarded = [];
}
