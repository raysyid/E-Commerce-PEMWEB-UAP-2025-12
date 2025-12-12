<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            //Pria
            [
                'name' => 'Kemeja Pria',
                'slug' => 'kemeja-pria',
                'description' => 'Kemeja kasual dan formal untuk pria, berbagai model dan ukuran',
            ],
            [
                'name' => 'Kaos Pria',
                'slug' => 'kaos-pria',
                'description' => 'Kaos polos, lengan pendek, lengan panjang untuk pria',
            ],
            [
                'name' => 'Celana Pria',
                'slug' => 'celana-pria',
                'description' => 'Celana jeans, chino, kargo untuk pria',
            ],
            [
                'name' => 'Jaket Pria',
                'slug' => 'jaket-pria',
                'description' => 'Jaket denim, bomber, hoodie untuk pria',
            ],
            [
                'name' => 'Tas Pria',
                'slug' => 'tas-pria',
                'description' => 'Tas ransel, selempang, tote bag untuk pria',
            ],
            [
                'name' => 'Sneakers Pria',
                'slug' => 'sneakers-pria',
                'description' => 'Sneakers branded dan lokal untuk pria',
            ],
            
            //Wanita
            [
                'name' => 'Dress',
                'slug' => 'dress',
                'description' => 'Dress casual, formal, midi, maxi untuk berbagai acara',
            ],
            [
                'name' => 'Kemeja Wanita',
                'slug' => 'kemeja-wanita',
                'description' => 'Kemeja wanita casual dan formal, berbagai model',
            ],
            [
                'name' => 'Hoodie Wanita',
                'slug' => 'hoodie-wanita',
                'description' => 'Hoodie dan sweater hoodie untuk wanita',
            ],
            [
                'name' => 'Sweater Wanita',
                'slug' => 'sweater-wanita',
                'description' => 'Sweater rajut dan knit untuk wanita',
            ],
            [
                'name' => 'Sneakers Wanita',
                'slug' => 'sneakers-wanita',
                'description' => 'Sneakers branded dan lokal untuk wanita',
            ],
            [
                'name' => 'Backpack Wanita',
                'slug' => 'backpack-wanita',
                'description' => 'Tas ransel untuk wanita, berbagai ukuran',
            ],
            [
                'name' => 'Handbag',
                'slug' => 'handbag',
                'description' => 'Tas tangan wanita, clutch, sling bag',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('product_categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}