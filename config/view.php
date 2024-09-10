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
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        \resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => Filter::string($env->get('VIEW_COMPILED_PATH', \realpath(\storage_path('framework/views')))),
];
