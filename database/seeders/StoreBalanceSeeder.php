<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoreBalanceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('store_balances')->insert([
            [
                'store_id' => 1, // pastikan store id 1 ADA
                'balance' => 2450000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
