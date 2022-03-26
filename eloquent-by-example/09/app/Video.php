<?php

namespace App;

use App\Traits\CommentableTrait;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use CommentableTrait;
}
