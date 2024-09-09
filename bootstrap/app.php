<?php

/**
 * Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * 🤵 The Proprietor: Tomáš Chochola
 * - Role: The Creator, Proprietor & Project Visionary
 * - Email: chocholatom1997@gmail.com
 * - GitHub: https://github.com/tomchochola
 * - Sponsor & License: https://github.com/sponsors/tomchochola
 * - Web: https://premierstacks.com
 */

declare(strict_types=1);

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\RouteRegistrar;
use Premierstacks\LaravelStack\Configuration\MiddlewareConfiguration;
use Premierstacks\LaravelStack\Configuration\ScheduleConfiguration;
use Premierstacks\LaravelStack\Container\Resolver;
use Premierstacks\LaravelStack\Exceptions\ExceptionHandler;

return Application::configure(basePath: \dirname(__DIR__))
    ->withRouting(
        using: static fn(): RouteRegistrar => Resolver::routeRegistrar()->group(__DIR__ . '/../routes/http.php'),
        commands: __DIR__ . '/../routes/console.php',
    )
    ->withSchedule(static function (Schedule $schedule): void {
        ScheduleConfiguration::configure($schedule);
    })
    ->withMiddleware(static function (Middleware $middleware): void {
        MiddlewareConfiguration::configure($middleware);
    })
    ->withExceptions()
    ->withSingletons([
        ExceptionHandlerContract::class => ExceptionHandler::class,
    ])
    ->create();
