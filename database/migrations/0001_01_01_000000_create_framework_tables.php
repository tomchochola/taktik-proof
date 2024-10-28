<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Premierstacks\LaravelStack\Container\Resolver;

return new class extends Migration {
    public function down(): void
    {
        Resolver::schemaBuilder()->drop('failed_jobs');
        Resolver::schemaBuilder()->drop('job_batches');
        Resolver::schemaBuilder()->drop('jobs');
        Resolver::schemaBuilder()->drop('cache_locks');
        Resolver::schemaBuilder()->drop('cache');
        Resolver::schemaBuilder()->drop('sessions');
    }

    public function up(): void
    {
        Resolver::schemaBuilder()->create('sessions', static function (Blueprint $table): void {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Resolver::schemaBuilder()->create('cache', static function (Blueprint $table): void {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Resolver::schemaBuilder()->create('cache_locks', static function (Blueprint $table): void {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        Resolver::schemaBuilder()->create('jobs', static function (Blueprint $table): void {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Resolver::schemaBuilder()->create('job_batches', static function (Blueprint $table): void {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Resolver::schemaBuilder()->create('failed_jobs', static function (Blueprint $table): void {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }
};
