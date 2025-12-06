<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            MemberUserSeeder::class,
            StoreSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
        ]);

        Artisan::call('images:sync');

        $this->command->info('✔ Sync gambar selesai setelah seeding!');
    }
}