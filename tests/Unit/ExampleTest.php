<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Premierstacks\PhpStack\Random\Random;

/**
 * @internal
 */
#[CoversClass(Random::class)]
#[Small]
class ExampleTest extends TestCase
{
    #[Test]
    public function testThatTrueIsTrue(): void
    {
        static::assertTrue(\mb_strlen(Random::code()) === 6);
    }
}
