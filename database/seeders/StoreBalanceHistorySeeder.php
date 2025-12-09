<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StoreBalanceHistorySeeder extends Seeder
{
    public function run(): void
    {
        // Ambil store_balance_id dari store_id = 1
        $storeBalance = DB::table('store_balances')->where('store_id', 1)->first();

        if (!$storeBalance) {
            $this->command->error("Store balance untuk store_id=1 belum ditemukan!");
            return;
        }

        DB::table('store_balance_histories')->insert([

            // 💰 Income transaksi pertama
            [
                'store_balance_id' => $storeBalance->id,
                'type' => 'income',
                'reference_id' => Str::uuid(),
                'reference_type' => 'order',
                'amount' => 150000,
                'remarks' => 'Pendapatan Order #INV-1001',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],

            // 💰 Income kedua
            [
                'store_balance_id' => $storeBalance->id,
                'type' => 'income',
                'reference_id' => Str::uuid(),
                'reference_type' => 'order',
                'amount' => 200000,
                'remarks' => 'Pendapatan Order #INV-1002',
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],

            // 🏧 Withdraw selesai
            [
                'store_balance_id' => $storeBalance->id,
                'type' => 'withdraw',
                'reference_id' => Str::uuid(),
                'reference_type' => 'withdrawal',
                'amount' => 100000,
                'remarks' => 'Withdraw berhasil diproses admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
