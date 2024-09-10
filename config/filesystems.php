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

use Premierstacks\LaravelStack\Config\Env;
use Premierstacks\PhpStack\Mixed\Filter;

$env = Env::inject();

return [
    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => Filter::string($env->get('FILESYSTEM_DISK', 'local')),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => \storage_path('app'),
            'throw' => true,
        ],

        'public' => [
            'driver' => 'local',
            'root' => \storage_path('app/public'),
            'url' => Filter::string($env->get('APP_URL', 'http://localhost:8000')) . '/storage',
            'visibility' => 'public',
            'throw' => true,
        ],

        's3' => [
            'driver' => 's3',
            'key' => Filter::nullableString($env->get('AWS_ACCESS_KEY_ID', null)),
            'secret' => Filter::nullableString($env->get('AWS_SECRET_ACCESS_KEY', null)),
            'region' => Filter::nullableString($env->get('AWS_DEFAULT_REGION', null)),
            'bucket' => Filter::nullableString($env->get('AWS_BUCKET', null)),
            'url' => Filter::nullableString($env->get('AWS_URL', null)),
            'endpoint' => Filter::nullableString($env->get('AWS_ENDPOINT', null)),
            'use_path_style_endpoint' => Filter::bool($env->get('AWS_USE_PATH_STYLE_ENDPOINT', false)),
            'throw' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        \public_path('storage') => \storage_path('app/public'),
    ],
];
