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
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'ivanalmadin0@gmail.com'],
            [
                'name' => 'Ivan Almadin',
                'password' => Hash::make('Admin@1234'),
                'is_admin' => true,
                'phone' => null,
                'recovery_email' => 'ivankimalmadin@acdeducation.com',
            ]
        );
    }
}
