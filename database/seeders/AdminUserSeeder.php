<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'phone_number' => '081111111111',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'phone_number' => '082222222222',
            'password' => Hash::make('admin456'),
            'role' => 'admin'
        ]);

    }
}