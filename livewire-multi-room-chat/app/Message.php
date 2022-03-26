<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Undocumented variable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
