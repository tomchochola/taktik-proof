<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Premierstacks\LaravelStack\Container\Resolve;

return new class extends Migration {
    public function down(): void
    {
        Resolve::schemaBuilder()->drop('comments');
        Resolve::schemaBuilder()->drop('articles');
    }

    public function up(): void
    {
        Resolve::schemaBuilder()->create('articles', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Resolve::schemaBuilder()->create('likes', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('source_user_id')->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('target_user_id')->nullable()->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('target_article_id')->nullable()->constrained('articles', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->unique(['source_user_id', 'target_user_id']);
            $table->unique(['source_user_id', 'target_article_id']);
        });
    }
};
