<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Like>
 */
class LikeFactory extends Factory
{
    #[\Override]
    public function definition(): array
    {
        return [
            'source_user_id' => UserFactory::new(),
            'target_user_id' => UserFactory::new(),
            'target_article_id' => ArticleFactory::new(),
        ];
    }
}
