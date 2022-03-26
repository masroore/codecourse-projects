<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
