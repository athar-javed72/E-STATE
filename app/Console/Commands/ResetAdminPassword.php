<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password {--email=test@example.com} {--password=password}';

    protected $description = 'Create/reset a local admin user (sets is_admin=true)';

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
                'is_admin' => true,
            ]);
            $this->info("Admin user created: {$email}");
        } else {
            $user->password = $password;
            $user->is_admin = true;
            $user->save();
            $this->info("Password reset for: {$email}");
        }

        $this->warn('Demo credentials are for local practice only. Change them before any public deploy.');

        return self::SUCCESS;
    }
}
