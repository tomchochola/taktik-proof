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

use Illuminate\Database\Migrations\Migration;
use Premierstacks\LaravelStack\Container\Resolver;
use Premierstacks\LaravelStack\Database\Migrator;

return new class extends Migration {
    public function down(): void
    {
        Resolver::schemaBuilder()->drop('verifications');
        Resolver::schemaBuilder()->drop('users_password_reset_tokens');
        Resolver::schemaBuilder()->drop('unlimited_tokens');
        Resolver::schemaBuilder()->drop('users');
    }

    public function up(): void
    {
        Migrator::inject()->createAuthenticatableTable('users');
        Migrator::inject()->createUnlimitedTokensTable('unlimited_tokens');
        Migrator::inject()->createUnlimitedTokensColumn('unlimited_tokens', 'user_id', 'users', 'id');
        Migrator::inject()->createPasswordResetTokensTable('users_password_reset_tokens');
        Migrator::inject()->createVerificationsTable('verifications');
    }
};
