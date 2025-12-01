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
                'name' => 'Elektronik',
                'tagline' => 'Produk elektronik modern',
                'description' => 'Kategori Elektronik menyediakan laptop, smartphone, kamera, dan perangkat teknologi lainnya untuk kebutuhan sehari-hari.'
            ],
            [
                'name' => 'Pakaian',
                'tagline' => 'Gaya fashion terbaru',
                'description' => 'Kategori Pakaian berisi outfit untuk pria dan wanita dengan berbagai pilihan model untuk setiap gaya.'
            ],
            [
                'name' => 'Aksesoris',
                'tagline' => 'Aksesoris kekinian',
                'description' => 'Kategori Aksesoris menghadirkan berbagai aksesori seperti jam tangan, topi, dan perhiasan untuk melengkapi penampilan kamu.'
            ],
            [
                'name' => 'Kecantikan',
                'tagline' => 'Perawatan terbaik bagi kulitmu',
                'description' => 'Kategori Kecantikan menyediakan skincare, makeup, dan produk perawatan lain untuk menjaga kesehatan dan pesonamu.'
            ],
            [
                'name' => 'Peralatan Rumah',
                'tagline' => 'Perlengkapan rumah tangga',
                'description' => 'Kategori Peralatan Rumah berisi berbagai alat rumah tangga yang mempermudah aktivitas sehari-hari di rumah.'
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