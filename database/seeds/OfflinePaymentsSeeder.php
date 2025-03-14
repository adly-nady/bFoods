<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfflinePaymentsSeeder extends Seeder
{
    public function run()
    {
        DB::table('offline_payments')->insert([
            [
                'id' => 1,
                'order_id' => 1, // Matches an order from OrdersSeeder
                'payment_info' => json_encode([
                    'method' => 'bank_transfer',
                    'bank_name' => 'Example Bank',
                    'account_number' => '1234567890',
                    'transaction_id' => 'TXN12345',
                ]),
                'status' => 0, // pending
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'order_id' => 2, // Matches an order from OrdersSeeder
                'payment_info' => json_encode([
                    'method' => 'cash_on_delivery',
                    'note' => 'Customer will pay upon delivery',
                ]),
                'status' => 1, // approved
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'order_id' => 3, // Matches an order from OrdersSeeder
                'payment_info' => json_encode([
                    'method' => 'bank_transfer',
                    'bank_name' => 'Another Bank',
                    'account_number' => '0987654321',
                    'transaction_id' => 'TXN67890',
                ]),
                'status' => 2, // denied
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}