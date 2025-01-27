<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Api\Like;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\Like\UserLikeDetachController;
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
#[CoversClass(UserLikeDetachController::class)]
#[Medium]
class UserLikeDetachControllerTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('providesLocale')]
    #[Test]
    public function postUsersDislike(string $locale): void
    {
        $this->setUpLocale($locale);

        $liked = UserFactory::new()->createOne();
        $user = UserFactory::new()->hasAttached($liked, [], 'likedUsers')->createOne();

        $this->assertDatabaseCount('likes', 1);

        $response = $this->setAuthenticatable($user)->form('POST', '/api/users/dislike', [
            'target_user_id' => $liked->getKey(),
        ]);

        $response->assertNoContent();

        $this->assertDatabaseEmpty('likes');
    }
}
