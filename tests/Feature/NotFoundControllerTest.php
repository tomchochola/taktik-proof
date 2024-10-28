<?php

declare(strict_types=1);

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Medium;
use PHPUnit\Framework\Attributes\Test;
use Premierstacks\LaravelStack\Http\Controllers\NotFoundController;
use Tests\TestCase;

/**
 * @internal
 */
#[CoversClass(NotFoundController::class)]
#[Medium]
class NotFoundControllerTest extends TestCase
{
    #[DataProvider('providesLocale')]
    #[Test]
    public function theApplicationHasNotFoundBoundary(string $locale): void
    {
        $this->setUpLocale($locale);

        $response = $this->get('/not-found');

        $response->assertNotFound();
    }
}
