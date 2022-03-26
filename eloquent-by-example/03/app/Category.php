<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps()
            ->withPivot('visible')
            ->wherePivot('visible', true);
    }
}
