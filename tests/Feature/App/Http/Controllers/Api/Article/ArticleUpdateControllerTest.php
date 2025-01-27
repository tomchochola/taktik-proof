<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Api\Article;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\Article\ArticleUpdateController;
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
#[CoversClass(ArticleUpdateController::class)]
#[Medium]
class ArticleUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('providesLocale')]
    #[Test]
    public function postArticlesUpdate(string $locale): void
    {
        $this->setUpLocale($locale);

        $user = UserFactory::new()->createOne();
        $old = ArticleFactory::new()->for($user)->createOne();
        $new = ArticleFactory::new()->makeOne();

        $response = $this->setAuthenticatable($user)->form('POST', '/api/articles/update', [
            'id' => $old->getKey(),
            'title' => $new->getAttribute('title'),
            'content' => $new->getAttribute('content'),
        ]);

        $response->assertNoContent();

        $this->assertDatabaseHas($new->getTable(), ['title' => $new->getAttribute('title')]);
    }
}
