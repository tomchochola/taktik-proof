<?php

declare(strict_types=1);

use Premierstacks\LaravelStack\Config\Env;
use Premierstacks\PhpStack\Mixed\Filter;

$env = Env::inject();

return [
    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

    'default' => Filter::string($env->get('MAIL_MAILER', 'array')),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "resend", "log", "array",
    |            "failover", "roundrobin"
    |
    */

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'scheme' => Filter::string($env->get('MAIL_SCHEME', 'tls')),
            'url' => Filter::nullableString($env->get('MAIL_URL', null)),
            'host' => Filter::string($env->get('MAIL_HOST', '127.0.0.1')),
            'port' => Filter::int($env->get('MAIL_PORT', 2_525)),
            'username' => Filter::nullableString($env->get('MAIL_USERNAME', null)),
            'password' => Filter::nullableString($env->get('MAIL_PASSWORD', null)),
            'timeout' => null,
            'local_domain' => Filter::nullableString($env->get('MAIL_EHLO_DOMAIN', \parse_url(Filter::string($env->get('APP_URL', 'http://localhost:8000')), \PHP_URL_HOST))),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => Filter::nullableString($env->get('POSTMARK_MESSAGE_STREAM_ID', null)),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => Filter::string($env->get('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i')),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => Filter::nullableString($env->get('MAIL_LOG_CHANNEL', null)),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all emails sent by your application to be sent from
    | the same address. Here you may specify a name and address that is
    | used globally for all emails that are sent by your application.
    |
    */

    'from' => [
        'address' => Filter::string($env->get('MAIL_FROM_ADDRESS', 'hello@example.com')),
        'name' => Filter::string($env->get('MAIL_FROM_NAME', 'Example')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => Filter::string($env->get('MAIL_MARKDOWN_THEME', 'default')),

        'paths' => [
            \resource_path('views/vendor/mail'),
        ],
    ],
];
