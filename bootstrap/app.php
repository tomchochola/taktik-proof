<?php

declare(strict_types=1);

use App\Http\Middleware\ThrottleMiddleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\RouteRegistrar;
use Premierstacks\LaravelStack\Configuration\MiddlewareConfiguration;
use Premierstacks\LaravelStack\Configuration\ScheduleConfiguration;
use Premierstacks\LaravelStack\Container\Resolve;
use Premierstacks\LaravelStack\Exceptions\ExceptionHandler;

return Application::configure(basePath: \dirname(__DIR__))
    ->withRouting(
        using: static fn(): RouteRegistrar => Resolve::routeRegistrar()->group(__DIR__ . '/../routes/http.php'),
        commands: __DIR__ . '/../routes/console.php',
    )
    ->withSchedule(static function (Schedule $schedule): void {
        ScheduleConfiguration::configure($schedule);
    })
    ->withMiddleware(static function (Middleware $middleware): void {
        MiddlewareConfiguration::configure($middleware);

        $middleware->append(ThrottleMiddleware::class);
    })
    ->withExceptions()
    ->withSingletons([
        ExceptionHandlerContract::class => ExceptionHandler::class,
    ])
    ->create();
