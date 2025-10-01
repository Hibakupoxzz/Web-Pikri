<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // User
        User::create([
            'name' => 'User',
            'email' => 'fiqri@gmail.com',
            'password' => Hash::make('fiqri123'),
            'role' => 'user',
        ]);
    }
}
