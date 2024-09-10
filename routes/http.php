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

use Illuminate\Routing\Router;
use Premierstacks\LaravelStack\Auth\Http\Controllers\AuthenticatableDestroyController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\AuthenticatableShowController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\AuthenticatableUpdateController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\CredentialsUpdateController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\FreeEmailVerificationController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\LoginController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\LogoutAllDevicesController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\LogoutCurrentDeviceController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\LogoutOtherDevicesController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\MineEmailVerificationController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\OccupiedEmailVerificationController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\PasswordForgotController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\PasswordResetController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\PasswordUpdateController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\RegisterController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\RetrieveAuthenticatableController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\SessionInvalidateController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\SessionRegenerateController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\VerificationCompleteController;
use Premierstacks\LaravelStack\Auth\Http\Controllers\VerificationShowController;
use Premierstacks\LaravelStack\Container\Resolver;
use Premierstacks\LaravelStack\Http\Controllers\NotFoundController;
use Premierstacks\LaravelStack\Http\Middleware\SetAuthDefaultsMiddleware;
use Premierstacks\LaravelStack\Http\Middleware\SmartTransactionMiddleware;
use Premierstacks\LaravelStack\Http\Middleware\ThrottleFailExceptMiddleware;
use Premierstacks\LaravelStack\Http\Middleware\ThrottlePassMiddleware;

Resolver::router()->view('api/swagger', 'psls::swagger', [
    'url' => Resolver::urlGeneratorContract()->to('docs/openapi.json'),
]);

Resolver::routeRegistrar()->prefix('api')->middleware(['encrypted_cookies', 'session', 'api_form_json', SmartTransactionMiddleware::class])->group(static function (Router $router): void {
    Resolver::routeRegistrar()->prefix('auth')->middleware([SetAuthDefaultsMiddleware::class . ':users', ThrottleFailExceptMiddleware::class . ':fail,5,600', ThrottlePassMiddleware::class . ':pass,5,600'])->group(static function (Router $router): void {
        $router->post('retrieve', [RetrieveAuthenticatableController::class, 'handle']);
        $router->post('login_verification', [OccupiedEmailVerificationController::class, 'handle'])->setDefaults([
            'scope' => 'login',
            'action' => 'login',
        ]);
        $router->post('login', [LoginController::class, 'handle']);
        $router->post('email_verification', [FreeEmailVerificationController::class, 'handle'])->setDefaults([
            'scope' => 'credentials_verification',
            'action' => 'email_verification',
        ]);
        $router->post('register', [RegisterController::class, 'handle']);
        $router->post('destroy_verification', [MineEmailVerificationController::class, 'handle'])->setDefaults([
            'scope' => 'authenticatable_destroy',
            'action' => 'authenticatable_destroy',
        ]);
        $router->post('destroy', [AuthenticatableDestroyController::class, 'handle']);
        $router->post('update', [AuthenticatableUpdateController::class, 'handle']);
        $router->post('update_credentials_verification', [MineEmailVerificationController::class, 'handle'])->setDefaults([
            'scope' => 'credentials_update',
            'action' => 'credentials_update',
        ]);
        $router->post('update_credentials', [CredentialsUpdateController::class, 'handle']);
        $router->get('show', [AuthenticatableShowController::class, 'handle']);
        $router->post('logout_current_device', [LogoutCurrentDeviceController::class, 'handle']);
        $router->post('logout_other_devices', [LogoutOtherDevicesController::class, 'handle']);
        $router->post('logout_all_devices', [LogoutAllDevicesController::class, 'handle']);
        $router->post('reset_password_verification', [PasswordForgotController::class, 'handle'])->setDefaults([
            'scope' => 'password_reset',
            'action' => 'password_reset',
        ]);
        $router->post('reset_password', [PasswordResetController::class, 'handle']);
        $router->post('update_password_verification', [MineEmailVerificationController::class, 'handle'])->setDefaults([
            'scope' => 'password_update',
            'action' => 'password_update',
        ]);
        $router->post('update_password', [PasswordUpdateController::class, 'handle']);
    });

    Resolver::routeRegistrar()->prefix('verifications')->middleware([ThrottleFailExceptMiddleware::class . ':fail,5,600', ThrottlePassMiddleware::class . ':pass,5,600'])->group(static function (Router $router): void {
        $router->post('complete', [VerificationCompleteController::class, 'handle']);
        $router->get('show', [VerificationShowController::class, 'handle']);
    });

    Resolver::routeRegistrar()->prefix('sessions')->middleware([ThrottleFailExceptMiddleware::class . ':fail,5,600', ThrottlePassMiddleware::class . ':pass,5,600'])->group(static function (Router $router): void {
        $router->post('invalidate', [SessionInvalidateController::class, 'handle']);
        $router->post('regenerate', [SessionRegenerateController::class, 'handle']);
    });

    $router->any('{any}', [NotFoundController::class, 'handle'])->where('any', '.*');
});

Resolver::routeRegistrar()->group(static function (Router $router): void {
    $router->any('{any}', [NotFoundController::class, 'handle'])->where('any', '.*');
});
