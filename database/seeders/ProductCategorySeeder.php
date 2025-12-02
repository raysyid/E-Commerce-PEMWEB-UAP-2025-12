<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kemeja Pria',
                'tagline' => 'kemeja pria vintage',
                'description' => 'kemeja pria kasual berkuatitas tinggi, mulai dari yang formal hingga kasual.'
            ],
            [
                'name' => 'Dress',
                'tagline' => 'Dress wanita cantik beragam',
                'description' => 'Dress wanita berkualitas tinggi. ukuran beragam dan bermacam macam.'
            ],
            [
                'name' => 'Sneakers Pria',
                'tagline' => 'Sneakers Vintage Pria',
                'description' => 'Sneaker branded murah dengan kondisi bagus dan terbaik.'
            ],
            [
                'name' => 'Handbag Wanita',
                'tagline' => 'Handbag preloved berkualitas',
                'description' => 'Handbag wanita Second dengan berbagai model dan kondisi terawat.'
            ],
            [
                'name' => 'Tas Pria',
                'tagline' => 'Tas Pria vintage dengan berbagai macam warna.',
                'description' => 'Tas branded berkualitas tinggi dengan berbagai macam pilihan.'
            ],
        ];

        foreach ($categories as $cat) {
            ProductCategory::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'tagline' => $cat['tagline'],
                'description' => $cat['description']
            ]);
        }
    }
}