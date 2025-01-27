<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Api\Article;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\Article\ArticleDestroyController;
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
#[CoversClass(ArticleDestroyController::class)]
#[Medium]
class ArticleDestroyControllerTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('providesLocale')]
    #[Test]
    public function postArticlesDestroy(string $locale): void
    {
        $this->setUpLocale($locale);

        $user = UserFactory::new()->createOne();
        $article = ArticleFactory::new()->for($user)->createOne();

        $response = $this->setAuthenticatable($user)->form('POST', '/api/articles/destroy', [
            'id' => $article->getKey(),
        ]);

        $response->assertNoContent();

        $this->assertDatabaseEmpty($article->getTable());
    }
}
