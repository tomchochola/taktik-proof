<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Api\Like;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\Like\UserLikeAttachController;
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
#[CoversClass(UserLikeAttachController::class)]
#[Medium]
class UserLikeAttachControllerTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('providesLocale')]
    #[Test]
    public function postUsersLike(string $locale): void
    {
        $this->setUpLocale($locale);

        $user = UserFactory::new()->createOne();
        $liked = UserFactory::new()->createOne();

        $this->assertDatabaseEmpty('likes');

        $response = $this->setAuthenticatable($user)->form('POST', '/api/users/like', [
            'target_user_id' => $liked->getKey(),
        ]);

        $response->assertNoContent();

        $this->assertDatabaseCount('likes', 1);
    }
}
