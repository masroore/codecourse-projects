<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::updated(function ($user) {
            if ($password = Arr::get($user->getChanges(), 'password')) {
                $user->storeCurrentPasswordInHistory($password);
            }
        });

        static::created(function ($user) {
            $user->storeCurrentPasswordInHistory($user->password);
        });
    }

    /**
     * Undocumented function.
     *
     * @param int $keep
     *
     * @return void
     */
    public function deletePasswordHistory($keep = 5)
    {
        $this->passwordHistory()
            ->where('id', '<=', $this->passwordHistory()->first()->id - $keep)
            ->delete();
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function passwordHistory()
    {
        return $this->hasMany(PasswordHistory::class)
            ->latest();
    }

    /**
     * Undocumented function.
     *
     * @param [type] $password
     *
     * @return void
     */
    protected function storeCurrentPasswordInHistory($password)
    {
        $this->passwordHistory()->create(compact('password'));
    }
}
