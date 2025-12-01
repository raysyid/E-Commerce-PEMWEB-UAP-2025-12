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
        $category = ProductCategory::where('name', 'Elektronik')->first();

        Product::create([
            'store_id' => 1,
            'product_category_id' => $category->id,
            'name' => 'Mesin Cuci Kels 8 Kg',
            'slug' => Str::slug('Mesin Cuci Kels 8KG'),
            'description' => 'Mesin Cuci Kels 8KG hemat energi hingga 50% berkat teknologi Inverter, dilengkapi M Smart Touch AI, enam mode pencucian, desain ramping dengan drum besar, delay function, serta fitur 1 tombol otomatis untuk mencuci lebih praktis.',
            'condition' => 'new',
            'price' => 2399000,
            'weight' => 25000,
            'stock' => 10
        ]);
    }
}
