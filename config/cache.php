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

use Illuminate\Support\Str;
use Premierstacks\LaravelStack\Config\Env;
use Premierstacks\PhpStack\Mixed\Filter;

$env = Env::inject();

return [
    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache store that will be used by the
    | framework. This connection is utilized if another isn't explicitly
    | specified when running a cache operation inside the application.
    |
    */

    'default' => Filter::string($env->get('CACHE_STORE', 'redis')),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported drivers: "array", "database", "file", "memcached",
    |                    "redis", "dynamodb", "octane", "null"
    |
    */

    'stores' => [
        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'table' => Filter::string($env->get('DB_CACHE_TABLE', 'cache')),
            'connection' => Filter::nullableString($env->get('DB_CACHE_CONNECTION', null)),
            'lock_connection' => Filter::nullableString($env->get('DB_CACHE_LOCK_CONNECTION', null)),
            'lock_table' => Filter::string($env->get('DB_CACHE_LOCK_TABLE', null)),
        ],

        'file' => [
            'driver' => 'file',
            'path' => \storage_path('framework/cache/data'),
            'lock_path' => \storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => Filter::nullableString($env->get('MEMCACHED_PERSISTENT_ID', null)),
            'sasl' => [
                Filter::nullableString($env->get('MEMCACHED_USERNAME', null)),
                Filter::nullableString($env->get('MEMCACHED_PASSWORD', null)),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => Filter::string($env->get('MEMCACHED_HOST', '127.0.0.1')),
                    'port' => Filter::int($env->get('MEMCACHED_PORT', 11_211)),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => Filter::string($env->get('REDIS_CACHE_CONNECTION', 'cache')),
            'lock_connection' => Filter::string($env->get('REDIS_CACHE_LOCK_CONNECTION', 'default')),
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => Filter::nullableString($env->get('AWS_ACCESS_KEY_ID', null)),
            'secret' => Filter::nullableString($env->get('AWS_SECRET_ACCESS_KEY', null)),
            'region' => Filter::string($env->get('AWS_DEFAULT_REGION', 'us-east-1')),
            'table' => Filter::string($env->get('DYNAMODB_CACHE_TABLE', 'cache')),
            'endpoint' => Filter::nullableString($env->get('DYNAMODB_ENDPOINT', null)),
        ],

        'octane' => [
            'driver' => 'octane',
        ],

        'null' => [
            'driver' => 'null',
        ],

        'off' => [
            'driver' => 'null',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing the APC, database, memcached, Redis, and DynamoDB cache
    | stores, there might be other applications using the same cache. For
    | that reason, you may prefix every cache key to avoid collisions.
    |
    */

    'prefix' => Filter::string($env->get('CACHE_PREFIX', '{' . Str::slug(Filter::string($env->get('APP_NAME', 'Laravel')) . '_' . Filter::string($env->get('APP_ENV', 'production')) . '_cache', language: null) . '}')),
];
