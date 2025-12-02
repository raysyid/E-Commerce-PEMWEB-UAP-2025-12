<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $storeId = 1; // Toko pertama

        $products = [
            [
                'name' => 'Handbag kulit asli spade pink',
                'category' => 'Handbag Wanita',
                'description' => 'kondisi jarang pakai, sesuai gambar, asli kulit, bisa cod',
                'price' => 85000,
                'weight' => 450,
                'stock' => 4
            ],
            [
                'name' => 'Dress Trusty Chiffon lake Smoke',
                'category' => 'Dress',
                'description' => 'Dress nyaman Dengan bahan Chiffon lembut, motif paisley gelap.',
                'price' => 95000,
                'weight' => 300,
                'stock' => 3
            ],
        ];

        foreach ($products as $p) {
            $category = ProductCategory::where('name', $p['category'])->first();

            Product::create([
                'store_id' => $storeId,
                'product_category_id' => $category->id,
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => $p['description'],
                'condition' => 'second', // PRELOVED
                'price' => $p['price'],
                'weight' => $p['weight'],
                'stock' => $p['stock']
            ]);
        }
    }
}