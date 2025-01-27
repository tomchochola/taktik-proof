<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Premierstacks\LaravelStack\Auth\Models\IntAuthenticatable;

class User extends IntAuthenticatable
{
    /**
     * @return HasMany<Article, $this>
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @return BelongsToMany<Article, $this>
     */
    public function likedArticles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'likes', 'source_user_id', 'target_article_id')->using(Like::class)->withTimestamps()->withPivot(['id', 'source_user_id', 'target_user_id', 'target_article_id']);
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function likedUsers(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'likes', 'source_user_id', 'target_user_id')->using(Like::class)->withTimestamps()->withPivot(['id', 'source_user_id', 'target_user_id', 'target_article_id']);
    }

    /**
     * @return HasMany<Like, $this>
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'source_user_id');
    }
}
