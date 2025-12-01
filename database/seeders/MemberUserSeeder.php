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
            'name' => 'member1',
            'email' => 'member1@gmail.com',
            'phone_number' => '083333333333',
            'password' => Hash::make('member123'),
            'role' => 'member'
        ]);

        // Member 2
        User::create([
            'name' => 'Member Dua',
            'email' => 'member2@example.com',
            'phone_number' => '084444444444',
            'password' => Hash::make('member456'),
            'role' => 'member'
        ]);
    }
}