<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoreBalanceSeeder extends Seeder
{
    public function run(): void
    {
        $existing = DB::table('store_balances')->where('store_id', 1)->first();

        if ($existing) {
            // update kalau sudah ada
            DB::table('store_balances')->where('store_id', 1)->update([
                'balance' => 2450000,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            // insert kalau belum ada
            DB::table('store_balances')->insert([
                'store_id' => 1,
                'balance' => 2450000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
