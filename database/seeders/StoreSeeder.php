<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        Store::create([
            'user_id' => 3,
            'name' => 'Toko Elektronik Jaya',
            'logo' => 'default.png',
            'about' => 'Toko elektronik terlengkap se-Malang raya.',
            'phone' => '08123456789',
            'address_id' => 'ADDR01',
            'city' => 'Malang',
            'address' => 'Jalan Mawar No. 10',
            'postal_code' => '65123',
            'is_verified' => true
        ]);
    }
}
