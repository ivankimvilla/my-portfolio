<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public const BOOTSTRAP_PASSWORD = 'K9v!R2s@L7q#M4x$P8dW6n';

    public function run(): void
    {
        $email = strtolower(trim((string) config('admin.email')));

        if ($email === '') {
            throw new RuntimeException('Set ADMIN_EMAIL before seeding the admin account.');
        }

        $user = User::firstOrNew(['email' => $email]);

        if (! $user->exists) {
            $user->name = config('admin.name', 'Portfolio Admin');
            $user->password = self::BOOTSTRAP_PASSWORD;
        }

        $user->is_admin = true;
        $user->save();

        $this->command?->info("Admin account {$email} is ready. Change the bootstrap password after signing in.");
    }
}