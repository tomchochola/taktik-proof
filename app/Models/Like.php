<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Premierstacks\LaravelStack\Eloquent\IntPivot;

class Like extends IntPivot
{
    /**
     * @var array<array-key, mixed>
     */
    protected $attributes = [];

    /**
     * @var array<array-key, mixed>
     */
    protected $casts = [
        'source_user_id' => 'int',
        'target_user_id' => 'int',
        'target_article_id' => 'int',
    ];

    protected $fillable = ['source_user_id', 'target_user_id', 'target_article_id'];

    /**
     * @return BelongsTo<User, $this>
     */
    public function sourceUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'source_user_id');
    }

    /**
     * @return BelongsTo<Article, $this>
     */
    public function targetArticle(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'target_article_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function targetUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
