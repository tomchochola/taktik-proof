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

use Premierstacks\LaravelStack\Config\Env;
use Premierstacks\PhpStack\Mixed\Filter;

$env = Env::inject();

return [
    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue supports a variety of backends via a single, unified
    | API, giving you convenient access to each backend using identical
    | syntax for each. The default queue connection is defined below.
    |
    */

    'default' => Filter::string($env->get('QUEUE_CONNECTION', 'redis')),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection options for every queue backend
    | used by your application. An example configuration is provided for
    | each backend supported by Laravel. You're also free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [
        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'connection' => Filter::nullableString($env->get('DB_QUEUE_CONNECTION', null)),
            'table' => Filter::string($env->get('DB_QUEUE_TABLE', 'jobs')),
            'queue' => Filter::string($env->get('DB_QUEUE', 'default')),
            'retry_after' => Filter::int($env->get('DB_QUEUE_RETRY_AFTER', 90)),
            'after_commit' => true,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => Filter::string($env->get('BEANSTALKD_QUEUE_HOST', 'localhost')),
            'queue' => Filter::string($env->get('BEANSTALKD_QUEUE', 'default')),
            'retry_after' => Filter::int($env->get('BEANSTALKD_QUEUE_RETRY_AFTER', 90)),
            'block_for' => 0,
            'after_commit' => true,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => Filter::nullableString($env->get('AWS_ACCESS_KEY_ID', null)),
            'secret' => Filter::nullableString($env->get('AWS_SECRET_ACCESS_KEY', null)),
            'prefix' => Filter::string($env->get('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id')),
            'queue' => Filter::string($env->get('SQS_QUEUE', 'default')),
            'suffix' => Filter::nullableString($env->get('SQS_SUFFIX', null)),
            'region' => Filter::string($env->get('AWS_DEFAULT_REGION', 'us-east-1')),
            'after_commit' => true,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => Filter::string($env->get('REDIS_QUEUE_CONNECTION', 'default')),
            'queue' => Filter::string($env->get('REDIS_QUEUE', 'default')),
            'retry_after' => Filter::int($env->get('REDIS_QUEUE_RETRY_AFTER', 90)),
            'block_for' => null,
            'after_commit' => true,
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
    | Job Batching
    |--------------------------------------------------------------------------
    |
    | The following options configure the database and table that store job
    | batching information. These options can be updated to any database
    | connection and table which has been defined by your application.
    |
    */

    'batching' => [
        'database' => Filter::string($env->get('DB_CONNECTION', 'mysql')),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control how and where failed jobs are stored. Laravel ships with
    | support for storing failed jobs in a simple file or in a database.
    |
    | Supported drivers: "database-uuids", "dynamodb", "file", "null"
    |
    */

    'failed' => [
        'driver' => Filter::string($env->get('QUEUE_FAILED_DRIVER', 'database-uuids')),
        'database' => Filter::string($env->get('DB_CONNECTION', 'mysql')),
        'table' => 'failed_jobs',
    ],
];
