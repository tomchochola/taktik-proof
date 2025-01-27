<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Premierstacks\LaravelStack\Throttle\Limit;
use Premierstacks\LaravelStack\Throttle\Limiter;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ThrottleMiddleware
{
    public function createLimit(string $key, int $attempts, int $seconds): Limit
    {
        return Limit::dependency($key, $attempts, $seconds);
    }

    public function createLimiter(Limit $limit): Limiter
    {
        return Limiter::inject(['limit' => $limit]);
    }

    /**
     * @param \Closure(Request): SymfonyResponse $next
     */
    public function handle(Request $request, \Closure $next, string $key = '', int $attempts = 60, int $seconds = 60): SymfonyResponse
    {
        $throttler = $this->createLimiter($this->createLimit($key, $attempts, $seconds))->authorize();

        try {
            return $next($request);
        } finally {
            $throttler->hit();
        }
    }
}
