<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Api\Article;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\Article\ArticleShowController;
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
#[CoversClass(ArticleShowController::class)]
#[Medium]
class ArticleShowControllerTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('providesLocale')]
    #[Test]
    public function getArticlesShow(string $locale): void
    {
        $this->setUpLocale($locale);

        $user = UserFactory::new()->createOne();
        $article = ArticleFactory::new()->createOne();

        $response = $this->setAuthenticatable($user)->get('/api/articles/show?id=' . $article->getKey());

        $response->assertOk();

        $response->assertJsonIsObject('data');

        $response->assertExactJsonStructure([
            'data' => [
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
            ],
        ]);
    }
}
