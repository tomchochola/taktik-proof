<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Premierstacks\LaravelStack\Testing\TestCase as VendorTestCase;

/**
 * @internal
 */
abstract class TestCase extends VendorTestCase
{
    use RefreshDatabase;
}
