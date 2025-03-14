<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'user_id' => 1, // Assumes a user with id=1 exists in users table
                'is_guest' => 0, // Registered user
                'order_amount' => 150.75,
                'coupon_discount_amount' => 10.00,
                'coupon_discount_title' => 'First Order Discount',
                'payment_status' => 'unpaid',
                'order_status' => 'pending',
                'total_tax_amount' => 15.08,
                'payment_method' => 'offline',
                'transaction_reference' => null,
                'delivery_address_id' => 1, // Assumes a delivery address with id=1 exists
                'created_at' => now(),
                'updated_at' => now(),
                'checked' => 0,
                'delivery_man_id' => null,
                'delivery_charge' => 5.00,
                'order_note' => 'Please deliver before 6 PM.',
                'coupon_code' => 'FIRST10',
                'order_type' => 'delivery',
                'branch_id' => 1, // Assumes a branch with id=1 exists
                'callback' => null,
                'delivery_date' => '2025-03-16',
                'delivery_time' => '17:00',
                'extra_discount' => 0.00,
                'delivery_address' => json_encode([
                    'address' => '123 Main St, City',
                    'latitude' => '23.8103',
                    'longitude' => '90.4125',
                ]),
                'preparation_time' => 30,
                'table_id' => null,
                'number_of_people' => null,
                'table_order_id' => null,
                'is_cutlery_required' => 1, // Cutlery required
            ],
            [
                'id' => 2,
                'user_id' => null, // Guest order
                'is_guest' => 1, // Guest user
                'order_amount' => 75.50,
                'coupon_discount_amount' => 0.00,
                'coupon_discount_title' => null,
                'payment_status' => 'paid',
                'order_status' => 'delivered',
                'total_tax_amount' => 7.55,
                'payment_method' => 'cash',
                'transaction_reference' => 'CASH123',
                'delivery_address_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'checked' => 1,
                'delivery_man_id' => 1, // Assumes a delivery man with id=1 exists
                'delivery_charge' => 3.00,
                'order_note' => null,
                'coupon_code' => null,
                'order_type' => 'pickup',
                'branch_id' => 1,
                'callback' => null,
                'delivery_date' => '2025-03-15',
                'delivery_time' => '12:30',
                'extra_discount' => 5.00,
                'delivery_address' => json_encode([
                    'address' => 'Pickup at Branch 1',
                    'latitude' => '23.8200',
                    'longitude' => '90.4100',
                ]),
                'preparation_time' => 20,
                'table_id' => null,
                'number_of_people' => null,
                'table_order_id' => null,
                'is_cutlery_required' => 0, // No cutlery required
            ],
            [
                'id' => 3,
                'user_id' => 2, // Assumes a user with id=2 exists
                'is_guest' => 0, // Registered user
                'order_amount' => 200.00,
                'coupon_discount_amount' => 20.00,
                'coupon_discount_title' => 'Special Offer',
                'payment_status' => 'unpaid',
                'order_status' => 'processing',
                'total_tax_amount' => 20.00,
                'payment_method' => 'offline',
                'transaction_reference' => null,
                'delivery_address_id' => 2, // Assumes a delivery address with id=2 exists
                'created_at' => now(),
                'updated_at' => now(),
                'checked' => 0,
                'delivery_man_id' => null,
                'delivery_charge' => 7.00,
                'order_note' => 'Include extra napkins.',
                'coupon_code' => 'SPECIAL20',
                'order_type' => 'delivery',
                'branch_id' => 1,
                'callback' => null,
                'delivery_date' => '2025-03-17',
                'delivery_time' => '14:00',
                'extra_discount' => 0.00,
                'delivery_address' => json_encode([
                    'address' => '456 Oak Ave, Town',
                    'latitude' => '23.8500',
                    'longitude' => '90.4200',
                ]),
                'preparation_time' => 45,
                'table_id' => null,
                'number_of_people' => null,
                'table_order_id' => null,
                'is_cutlery_required' => 1, // Cutlery required
            ],
        ]);
    }
}