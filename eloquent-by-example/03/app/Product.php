<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->withTimestamps()
            ->withPivot('visible')
            ->wherePivot('visible', true);
    }
}
