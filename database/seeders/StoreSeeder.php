<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        Store::create([
            'user_id' => 2,
            'name' => 'kittylona',
            'logo' => 'default.png',
            'about' => 'Thrift curated | Coquette, Y2K, Morikei, Gothic, Grunge, Fairy & Kawaii',
            'phone' => '08123456789',
            'address_id' => 'ADDR01',
            'city' => 'Makassar',
            'address' => 'Jalan Mawar No. 10',
            'postal_code' => '90123',
            'is_verified' => true
        ]);
    }
}