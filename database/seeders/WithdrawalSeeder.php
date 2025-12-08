<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WithdrawalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('withdrawals')->insert([
            [
                'store_balance_id' => 1,
                'amount' => 500000,
                'bank_account_name' => 'Lona',
                'bank_account_number' => '1092345678',
                'bank_name' => 'BCA',
                'status' => 'pending',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'store_balance_id' => 1,
                'amount' => 700000,
                'bank_account_name' => 'Gandi Fatur',
                'bank_account_number' => '8871234567',
                'bank_name' => 'BRI',
                'status' => 'approved',
                'created_at' => Carbon::now()->subDays(12),
                'updated_at' => Carbon::now()->subDays(12),
            ],
            [
                'store_balance_id' => 1,
                'amount' => 300000,
                'bank_account_name' => 'Gandi Fatur',
                'bank_account_number' => '2020123456',
                'bank_name' => 'BNI',
                'status' => 'rejected',
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(25),
            ],
        ]);
    }
}
