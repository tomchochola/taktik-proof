<?php

declare(strict_types=1);

use Premierstacks\LaravelStack\Config\Env;
use Premierstacks\PhpStack\Mixed\Filter;

$env = Env::inject();

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => Filter::nullableString($env->get('POSTMARK_TOKEN', null)),
    ],

    'ses' => [
        'key' => Filter::nullableString($env->get('AWS_ACCESS_KEY_ID', null)),
        'secret' => Filter::nullableString($env->get('AWS_SECRET_ACCESS_KEY', null)),
        'region' => Filter::nullableString($env->get('AWS_DEFAULT_REGION', 'us-east-1')),
    ],

    'resend' => [
        'key' => Filter::nullableString($env->get('RESEND_KEY', null)),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => Filter::nullableString($env->get('SLACK_BOT_USER_OAUTH_TOKEN', null)),
            'channel' => Filter::nullableString($env->get('SLACK_BOT_USER_DEFAULT_CHANNEL', null)),
        ],
    ],
];
