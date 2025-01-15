<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Premierstacks\LaravelStack\Container\Resolve;
use Premierstacks\LaravelStack\Database\Migrator;

return new class extends Migration {
    public function down(): void
    {
        Resolve::schemaBuilder()->drop('verifications');
        Resolve::schemaBuilder()->drop('users_password_reset_tokens');
        Resolve::schemaBuilder()->drop('unlimited_tokens');
        Resolve::schemaBuilder()->drop('users');
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
