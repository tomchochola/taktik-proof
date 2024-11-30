<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::query()->toBase()->exists()) {
            return;
        }

        UserFactory::new()->createOne([
            'email' => 'email@email.com',
            'locale' => 'en',
        ]);
    }
}
