<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password {--email=test@example.com} {--password=password}';

    protected $description = 'Reset admin user password (default: test@example.com / password)';

    public function handle(): int
    {
        $email = $this->option('email');
        $password = $this->option('password');

        $user = User::where('email', $email)->first();

        if (! $user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => $email,
                'password' => $password,
            ]);
            $this->info("Admin user created: {$email}");
        } else {
            $user->password = $password;
            $user->save();
            $this->info("Password reset for: {$email}");
        }

        $this->info('You can now login with the above email and password.');

        return self::SUCCESS;
    }
}
