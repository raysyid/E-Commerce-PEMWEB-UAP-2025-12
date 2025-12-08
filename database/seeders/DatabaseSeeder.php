<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\StoreBalanceSeeder;
use Database\Seeders\WithdrawalSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            MemberUserSeeder::class,
            StoreSeeder::class,

            StoreBalanceSeeder::class,   // ✅ WAJIB sebelum withdrawal
            WithdrawalSeeder::class,    // ✅ BARU BOLEH withdraw

            ProductCategorySeeder::class,
            ProductSeeder::class,
        ]);

        Artisan::call('images:sync');

        $this->command->info('✔ Sync gambar selesai setelah seeding!');
    }
}
