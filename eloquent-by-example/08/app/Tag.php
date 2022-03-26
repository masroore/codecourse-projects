<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function topics()
    {
        return $this->morphedByMany(Topic::class, 'taggable');
    }

    public function lessons()
    {
        return $this->morphedByMany(Lesson::class, 'taggable');
    }

    public function getTaggablesAttribute()
    {
        return collect()->merge($this->topics)->merge($this->lessons)->sortByDesc('created_at');
    }
}
