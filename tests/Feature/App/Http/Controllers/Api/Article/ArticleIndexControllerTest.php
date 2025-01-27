<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Api\Article;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\Article\ArticleIndexController;
use Database\Factories\ArticleFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @internal
 */
#[CoversClass(ArticleIndexController::class)]
#[Medium]
class ArticleIndexControllerTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('providesLocale')]
    #[Test]
    public function getArticlesIndex(string $locale): void
    {
        $this->setUpLocale($locale);

        $user = UserFactory::new()->createOne();
        $article = ArticleFactory::new()->createOne();

        $response = $this->setAuthenticatable($user)->get('/api/articles/index');

        $response->assertOk();

        $response->assertJsonIsArray('data');

        $response->assertExactJsonStructure([
            'data' => [[
                'id',
                'type',
                'slug',
                'attributes' => [
                    'user_id',
                    'title',
                    'content',
                    'created_at',
                    'updated_at',
                ],
            ]],
            'meta' => [
                'last_page',
            ],
        ]);
    }
}
