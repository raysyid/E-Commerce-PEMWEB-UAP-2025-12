<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $storeId = 1; // Toko pertama

        $products = [
            [
                'name' => 'Handbag kulit asli spade pink',
                'category' => 'Handbag',
                'description' => 'kondisi jarang pakai, sesuai gambar, asli kulit, bisa cod',
                'price' => 500000,
                'weight' => 600,
                'stock' => 1,
                'images' => ['handbag.webp']
            ],
            [
                'name' => 'Dress Trusty Chiffon lake Smoke',
                'category' => 'Dress',
                'description' => 'Dress nyaman Dengan bahan Chiffon lembut, motif paisley gelap.',
                'price' => 75000,
                'weight' => 300,
                'stock' => 1,
                'images' => ['cifon.webp']
            ],
            [
                'name' => 'Closshi White Stretch Shirt • Coquette Kawaii Y2K Harajuku T',
                'category' => 'Kemeja Wanita',
                'description' => 'Atasan putih dari Closshi, model stretch fitted yang clean dan feminim.',
                'price' => 39000,
                'weight' => 200,
                'stock' => 1,
                'images' => ['closshi1.jpg']
            ],
            [
                'name' => 'Lace Midi Dress • KIYOKO TAKASE • Coquette Mori Girl Lolita',
                'category' => 'Dress',
                'description' => 'Dress Mori Girl aesthetic ala Jepang, sangat cute dan lembut.',
                'price' => 135000,
                'weight' => 200,
                'stock' => 1,
                'images' => ['lace_midi.jpg']
            ],
            [
                'name' => 'Handbag Roosy x Hello Kitty',
                'category' => 'Handbag',
                'description' => 'Tas hitam brand lokal, bisa sling, jinjing dan shoulder.',
                'price' => 340000,
                'weight' => 200,
                'stock' => 1,
                'images' => ['roosy_kitty.jpg']
            ],
            [
                'name' => 'GAP Hoodie',
                'category' => 'Hoodie Wanita',
                'description' => 'Size L. Warna baby pink, rib mulus, logo bordir, fulltag',
                'price' => 96000,
                'weight' => 250,
                'stock' => 1,
                'images' => ['gap_hoodie_1.jpg']
            ],
            [
                'name' => 'Cream/White Knit Sweater',
                'category' => 'Sweater Wanita',
                'description' => 'Cute stitch details, PL: 48, P: 60, bisa stretch!',
                'price' => 160000,
                'weight' => 300,
                'stock' => 1,
                'images' => ['sweater1.jpg']
            ],
            [
                'name' => 'Nike P6000',
                'category' => 'Sneakers Wanita',
                'description' => 'Size : 39/25cm, Condition : 90%',
                'price' => 850000,
                'weight' => 335,
                'stock' => 1,
                'images' => ['nike_p6000.jpg']
            ],
            [
                'name' => 'Chanel ransel gabrielle autentik',
                'category' => 'Backpack Wanita',
                'description' => 'Minus tali rantai kena cat ya karena abis di-repaint sedikit.',
                'price' => 550000,
                'weight' => 500,
                'stock' => 1,
                'images' => ['chanel_gabrielle.jpg']
            ],
            [
                'name' => 'y2k opemine tank top hoodie',
                'category' => 'Hoodie Wanita',
                'description' => 'size: 60x37, idr: 95k',
                'price' => 95000,
                'weight' => 200,
                'stock' => 1,
                'images' => ['y2k_hoodie.jpg']
            ],
        ];

        foreach ($products as $p) {

            $category = ProductCategory::firstOrCreate([
                'name' => $p['category']
            ]);

            $product = Product::create([
                'store_id' => $storeId,
                'product_category_id' => $category->id,
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => $p['description'],
                'condition' => 'second',
                'price' => $p['price'],
                'weight' => $p['weight'],
                'stock' => $p['stock'],
            ]);

            // SIMPAN GAMBAR
            foreach ($p['images'] as $index => $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $img,
                    'is_thumbnail' => $index === 0 ? 1 : 0
                ]);
            }
        }
    }
}
