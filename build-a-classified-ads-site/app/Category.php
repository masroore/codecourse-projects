<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = ['name', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeWithListingsInArea($query, Area $area)
    {
        return $query->with(['listings' => function ($q) use ($area) {
            $q->isLive()->inArea($area);
        }]);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
