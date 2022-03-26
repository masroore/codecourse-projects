<?php

namespace App;

use App\Tweets\Entities\EntityExtractor;
use App\Tweets\Entities\EntityType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function (self $tweet) {
            $tweet->entities()->createMany(
                (new EntityExtractor($tweet->body))->getAllEntities()
            );
        });
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function scopeParent(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function originalTweet()
    {
        return $this->hasOne(self::class, 'id', 'original_tweet_id');
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
        return $this->hasMany(self::class, 'original_tweet_id');
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function retweetedTweet()
    {
        return $this->hasOne(self::class, 'original_tweet_id', 'id');
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function media()
    {
        return $this->hasMany(TweetMedia::class);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mentions()
    {
        return $this->hasMany(Entity::class)
            ->whereType(EntityType::MENTION);
    }
}
