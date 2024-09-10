<?php

/**
 * @author Tomáš Chochola <chocholatom1997@gmail.com>
 * @copyright Copyright © 2024+ Tomáš Chochola <chocholatom1997@gmail.com> - All Rights Reserved
 *
 * @license
 *
 * This software is the exclusive property of Tomáš Chochola, protected by copyright laws.
 * Although the source code may be accessible, it is not free for use without a valid license.
 * A valid license, obtainable through proper channels, is required for any software use.
 * For licensing or inquiries, please contact Tomáš Chochola or refer to the GitHub Sponsors page.
 *
 * The full license terms are detailed in the LICENSE.md file within the source code repository.
 * The terms are subject to changes. Users are encouraged to review them periodically.
 *
 * @see {@link https://github.com/tomchochola} Personal GitHub
 * @see {@link https://github.com/premierstacks} Premierstacks GitHub
 * @see {@link https://github.com/sponsors/tomchochola} Sponsor & License
 * @see {@link https://premierstacks.com} Premierstacks website
 */

declare(strict_types=1);

use Illuminate\Support\Str;
use Premierstacks\LaravelStack\Config\Env;
use Premierstacks\PhpStack\Mixed\Filter;

$env = Env::inject();

return [
    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => Filter::string($env->get('DB_CONNECTION', 'mysql')),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => Filter::nullableString($env->get('DB_URL', null)),
            'database' => Filter::string($env->get('DB_DATABASE', \database_path('database.sqlite'))),
            'prefix' => '',
            'foreign_key_constraints' => Filter::bool($env->get('DB_FOREIGN_KEYS', true)),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => Filter::nullableString($env->get('DB_URL', null)),
            'host' => Filter::string($env->get('DB_HOST', '127.0.0.1')),
            'port' => Filter::int($env->get('DB_PORT', 3_306)),
            'database' => Filter::string($env->get('DB_DATABASE', 'laravel')),
            'username' => Filter::string($env->get('DB_USERNAME', 'root')),
            'password' => Filter::string($env->get('DB_PASSWORD', '')),
            'unix_socket' => Filter::string($env->get('DB_SOCKET', '')),
            'charset' => Filter::string($env->get('DB_CHARSET', 'utf8mb4')),
            'collation' => Filter::string($env->get('DB_COLLATION', 'utf8mb4_0900_ai_ci')),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => \extension_loaded('pdo_mysql') ? \array_filter([
                \PDO::MYSQL_ATTR_SSL_CA => Filter::nullableString($env->get('MYSQL_ATTR_SSL_CA', null)),
            ], static fn(mixed $value): bool => $value !== null) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => Filter::nullableString($env->get('DB_URL', null)),
            'host' => Filter::string($env->get('DB_HOST', '127.0.0.1')),
            'port' => Filter::int($env->get('DB_PORT', 3_306)),
            'database' => Filter::string($env->get('DB_DATABASE', 'laravel')),
            'username' => Filter::string($env->get('DB_USERNAME', 'root')),
            'password' => Filter::string($env->get('DB_PASSWORD', '')),
            'unix_socket' => Filter::string($env->get('DB_SOCKET', '')),
            'charset' => Filter::string($env->get('DB_CHARSET', 'utf8mb4')),
            'collation' => Filter::string($env->get('DB_COLLATION', 'utf8mb4_0900_ai_ci')),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => \extension_loaded('pdo_mysql') ? \array_filter([
                \PDO::MYSQL_ATTR_SSL_CA => Filter::nullableString($env->get('MYSQL_ATTR_SSL_CA', null)),
            ], static fn(mixed $value): bool => $value !== null) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => Filter::nullableString($env->get('DB_URL', null)),
            'host' => Filter::string($env->get('DB_HOST', '127.0.0.1')),
            'port' => Filter::int($env->get('DB_PORT', 5_432)),
            'database' => Filter::string($env->get('DB_DATABASE', 'laravel')),
            'username' => Filter::string($env->get('DB_USERNAME', 'root')),
            'password' => Filter::string($env->get('DB_PASSWORD', '')),
            'charset' => Filter::string($env->get('DB_CHARSET', 'utf8')),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => Filter::nullableString($env->get('DB_URL', null)),
            'host' => Filter::string($env->get('DB_HOST', 'localhost')),
            'port' => Filter::int($env->get('DB_PORT', 1_433)),
            'database' => Filter::string($env->get('DB_DATABASE', 'laravel')),
            'username' => Filter::string($env->get('DB_USERNAME', 'root')),
            'password' => Filter::string($env->get('DB_PASSWORD', '')),
            'charset' => Filter::string($env->get('DB_CHARSET', 'utf8')),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => Filter::string($env->get('DB_ENCRYPT', 'yes')),
            // 'trust_server_certificate' => Filter::string($env->get('DB_TRUST_SERVER_CERTIFICATE', 'false')),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [
        'client' => Filter::string($env->get('REDIS_CLIENT', 'phpredis')),

        'options' => [
            'cluster' => Filter::string($env->get('REDIS_CLUSTER', 'redis')),
            'prefix' => Filter::string($env->get('REDIS_PREFIX', '{' . Str::slug(Filter::string($env->get('APP_NAME', 'Laravel')) . '_' . Filter::string($env->get('APP_ENV', 'production')) . '_database', language: null) . '}')),
        ],

        'default' => [
            'url' => Filter::nullableString($env->get('REDIS_URL', null)),
            'host' => Filter::string($env->get('REDIS_HOST', '127.0.0.1')),
            'username' => Filter::nullableString($env->get('REDIS_USERNAME', null)),
            'password' => Filter::nullableString($env->get('REDIS_PASSWORD', null)),
            'port' => Filter::int($env->get('REDIS_PORT', 6_379)),
            'database' => Filter::int($env->get('REDIS_DB', 0)),
        ],

        'cache' => [
            'url' => Filter::nullableString($env->get('REDIS_URL', null)),
            'host' => Filter::string($env->get('REDIS_HOST', '127.0.0.1')),
            'username' => Filter::nullableString($env->get('REDIS_USERNAME', null)),
            'password' => Filter::nullableString($env->get('REDIS_PASSWORD', null)),
            'port' => Filter::int($env->get('REDIS_PORT', 6_379)),
            'database' => Filter::int($env->get('REDIS_CACHE_DB', 1)),
        ],
    ],
];
