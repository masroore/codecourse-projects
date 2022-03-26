<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
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

    /**
     * [isOnlyAdminInTeam description].
     *
     * @param Team $team [description]
     *
     * @return bool [description]
     */
    public function isOnlyAdminInTeam(Team $team)
    {
        return $this->hasRole('team_admin', $team->id) &&
                1 === $team->users()->whereRoleIs('team_admin', $team->id)->count();
    }

    /**
     * [teams description].
     *
     * @return [type] [description]
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class)
            ->withTimestamps();
    }
}
