<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * Undocumented function.
     *
     * @return void
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
