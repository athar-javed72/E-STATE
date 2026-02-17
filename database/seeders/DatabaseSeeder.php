<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user: plain password so User model's "hashed" cast hashes it once
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
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
