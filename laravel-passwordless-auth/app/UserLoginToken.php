<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserLoginToken extends Model
{
    public const TOKEN_EXPIRY = 120;

    protected $table = 'users_login_tokens';

    protected $fillable = [
        'token',
    ];

    public function isExpired()
    {
        return $this->created_at->diffInSeconds(Carbon::now()) > self::TOKEN_EXPIRY;
    }

    public function scopeExpired($query)
    {
        return $query->where('created_at', '<', Carbon::now()->subSeconds(self::TOKEN_EXPIRY));
    }

    public function belongsToEmail($email)
    {
        return (bool) (1 === $this->user->where('email', $email)->count());
    }

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
