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
                'name' => 'Dress',
                'tagline' => 'Dress wanita cantik beragam',
                'description' => 'Dress wanita berkualitas tinggi. ukuran beragam dan bermacam macam.'
            ],
            [
                'name' => 'Sneakers Wanita',
                'tagline' => 'Sneakers Vintage Wanita',
                'description' => 'Sneaker branded murah dengan kondisi bagus dan terbaik.'
            ],
            [
                'name' => 'Handbag',
                'tagline' => 'Handbag preloved berkualitas',
                'description' => 'Handbag wanita Second dengan berbagai model dan kondisi terawat.'
            ],
            [
                'name' => 'Backpack Wanita',
                'tagline' => 'Backpack preloved, ringan dan fungsional',
                'description' => 'Backpack preloved dengan desain praktis dan banyak kompartemen, cocok untuk aktivitas kuliah, kerja, atau jalan-jalan.'
            ],
            [
                'name' => 'Hoodie Wanita',
                'tagline' => 'Hoodie wanita preloved, cozy dan stylish',
                'description' => 'Hoodie wanita preloved dengan bahan lembut yang nyaman, cocok untuk tampilan casual dan streetwear harian.'
            ],
            [
                'name' => 'Sweater Wanita',
                'tagline' => 'Sweater preloved lembut dan hangat',
                'description' => 'Sweater wanita preloved dengan bahan nyaman dan desain yang timeless, pas untuk suasana santai atau musim dingin.'
            ],
            [
                'name' => 'Kemeja Wanita',
                'tagline' => 'Kemeja wanita preloved dengan berbagai gaya',
                'description' => 'Kemeja wanita preloved berkualitas dengan berbagai model, from casual hingga formal'
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