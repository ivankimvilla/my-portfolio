<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');

        if (! $email || ! $password) {
            return;
        }

        User::updateOrCreate(
            ['email' => strtolower(trim($email))],
            [
                'name' => config('admin.name', 'Portfolio Admin'),
                'password' => Hash::make($password),
            ],
        );
    }
}
