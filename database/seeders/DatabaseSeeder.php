<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Local/demo admin only — change password before any real deploy
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'is_admin' => true,
            ]
        );

        $this->call([
            AgentSeeder::class,
            PropertySeeder::class,
            BlogSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
