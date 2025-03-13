<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductByBranchesSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_by_branches')->insert([
            'id' => 1,
            'product_id' => 1,
            'price' => 10.00,
            'discount_type' => 'percent',
            'discount' => 0.00,
            'branch_id' => 1,
            'is_available' => 1,
            'variations' => '[]',
            'created_at' => '2023-09-06 08:40:57',
            'updated_at' => '2023-09-06 08:40:57',
            'stock_type' => 'unlimited',
            'stock' => 0,
            'sold_quantity' => 0,
        ]);
    }
}