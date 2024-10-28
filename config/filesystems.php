<?php

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
            'root' => \storage_path('app/private'),
            'visibility' => 'private',
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
            'visibility' => 'public',
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
