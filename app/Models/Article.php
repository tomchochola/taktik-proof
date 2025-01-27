<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Premierstacks\LaravelStack\Eloquent\IntModel;
use Premierstacks\PhpStack\Mixed\Assert;

class Article extends IntModel
{
    /**
     * @var array<array-key, mixed>
     */
    protected $attributes = [
        'id' => null,
        'title' => null,
        'content' => null,
        'user_id' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    /**
     * @var array<array-key, mixed>
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    protected $fillable = ['title', 'content', 'user_id'];

    public function getUserId(): int
    {
        return Assert::int($this->getAttribute('user_id'));
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function liked(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'target_article_id', 'source_user_id')->using(Like::class)->withTimestamps()->withPivot(['source_user_id', 'target_user_id', 'target_article_id']);
    }

    /**
     * @return HasMany<Like, $this>
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
