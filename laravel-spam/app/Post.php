<?php

namespace App;

use App\Spam\Spammable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Spammable;

    public function getSpamColumns()
    {
        return [
            'body' => 'body',
            'author' => 'user.name',
            'author_email' => 'user.email',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
