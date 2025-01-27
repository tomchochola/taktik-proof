<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Article;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Article::query()->toBase()->exists()) {
            return;
        }

        ArticleFactory::new()->createMany(50);
    }
}
