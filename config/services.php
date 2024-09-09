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
