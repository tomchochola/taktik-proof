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
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the bcrypt algorithm is
    | used; however, you remain free to modify this option if you wish.
    |
    | Supported: "bcrypt", "argon", "argon2id"
    |
    */

    'driver' => Filter::string($env->get('HASH_DRIVER', 'argon2id')),

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options that should be used when
    | passwords are hashed using the Bcrypt algorithm. This will allow you
    | to control the amount of time it takes to hash the given password.
    |
    */

    'bcrypt' => [
        'rounds' => Filter::int($env->get('BCRYPT_ROUNDS', 12)),
        'verify' => Filter::bool($env->get('HASH_VERIFY', true)),
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options that should be used when
    | passwords are hashed using the Argon algorithm. These will allow you
    | to control the amount of time it takes to hash the given password.
    |
    */

    'argon' => [
        'memory' => Filter::int($env->get('ARGON_MEMORY', 65_536)),
        'threads' => Filter::int($env->get('ARGON_THREADS', 1)),
        'time' => Filter::int($env->get('ARGON_TIME', 4)),
        'verify' => Filter::bool($env->get('HASH_VERIFY', true)),
    ],

    /*
    |--------------------------------------------------------------------------
    | Rehash On Login
    |--------------------------------------------------------------------------
    |
    | Setting this option to true will tell Laravel to automatically rehash
    | the user's password during login if the configured work factor for
    | the algorithm has changed, allowing graceful upgrades of hashes.
    |
    */

    'rehash_on_login' => true,
];
