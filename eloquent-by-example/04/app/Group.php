<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function topics()
    {
        return $this->hasManyThrough(Topic::class, User::class);
    }
}
