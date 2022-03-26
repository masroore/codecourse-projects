<?php

namespace App;

use App\Tweets\TweetType;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
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
     * Undocumented function.
     *
     * @return void
     */
    public function avatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mp';
    }

    /**
     * Undocumented function.
     *
     * @return bool
     */
    public function hasLiked(Tweet $tweet)
    {
        return $this->likes->contains('tweet_id', $tweet->id);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function following()
    {
        return $this->belongsToMany(
            self::class,
            'followers',
            'user_id',
            'following_id'
        );
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function followers()
    {
        return $this->belongsToMany(
            self::class,
            'followers',
            'following_id',
            'user_id'
        );
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function tweetsFromFollowing()
    {
        return $this->hasManyThrough(
            Tweet::class,
            Follower::class,
            'user_id',
            'user_id',
            'id',
            'following_id'
        );
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function retweets()
    {
        return $this->hasMany(Tweet::class)
            ->where('type', TweetType::RETWEET)
            ->orWhere('type', TweetType::QUOTE);
    }
}
