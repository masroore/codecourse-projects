<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;

    public function scopeWithCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function getUrl()
    {
        return $this->url;
    }
}
