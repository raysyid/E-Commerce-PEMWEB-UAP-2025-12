<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MemberUserSeeder extends Seeder
{
    public function run(): void
    {
        // Member 1
        User::create([
            'name' => 'Lona',
            'email' => 'lona@gmail.com',
            'phone_number' => '083333333333',
            'password' => Hash::make('lona123'),
            'role' => 'member'
        ]);

        // Member 2
        User::create([
            'name' => 'agus',
            'email' => 'agus@gmail.com',
            'phone_number' => '084444444444',
            'password' => Hash::make('agus'),
            'role' => 'member'
        ]);
    }
}