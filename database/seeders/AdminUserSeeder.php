<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public const ADMIN_EMAIL = 'admin@example.com';
    public const ADMIN_PASSWORD = 'R8v!qN4#Lz2@Wm7$Kp9x';

    public function run(): void
    {
        if (app()->environment('production')) {
            throw new RuntimeException('The development admin seeder cannot run in production.');
        }

        User::updateOrCreate(
            ['email' => self::ADMIN_EMAIL],
            [
                'name' => config('admin.name', 'Portfolio Admin'),
                'password' => self::ADMIN_PASSWORD,
                'is_admin' => true,
            ],
        );

        $this->command?->info('Development admin account seeded.');
    }
}