<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Api\Article;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\Article\ArticleStoreController;
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
#[CoversClass(ArticleStoreController::class)]
#[Medium]
class ArticleStoreControllerTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('providesLocale')]
    #[Test]
    public function postArticlesStore(string $locale): void
    {
        $this->setUpLocale($locale);

        $user = UserFactory::new()->createOne();
        $article = ArticleFactory::new()->makeOne();

        $response = $this->setAuthenticatable($user)->form('POST', '/api/articles/store', [
            'title' => $article->getAttribute('title'),
            'content' => $article->getAttribute('content'),
        ]);

        $response->assertOk();

        $response->assertJsonIsObject('data');

        $response->assertExactJsonStructure([
            'data' => [
                'id',
                'type',
                'slug',
            ],
        ]);

        $this->assertDatabaseCount($article->getTable(), 1);
    }
}
