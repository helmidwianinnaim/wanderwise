<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@wanderwise.com'],
            [
                'name'     => 'Admin WanderWise',
                'email'    => 'admin@wanderwise.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );
    }
}
