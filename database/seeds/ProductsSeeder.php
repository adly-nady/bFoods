<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'image' => '2023-09-06-64f83b1948ac3.png',
            'price' => 10.00,
            'variations' => '[]',
            'add_ons' => '[]',
            'tax' => 0.00,
            'available_time_starts' => '10:30:00',
            'available_time_ends' => '19:30:00',
            'status' => 1,
            'created_at' => '2023-09-06 08:40:57',
            'updated_at' => '2023-09-06 08:40:57',
            'attributes' => '[]',
            'category_ids' => '[{"id":"1","position":1},{"id":"2","position":2}]',
            'choice_options' => '[]',
            'discount' => 0.00,
            'discount_type' => 'percent',
            'tax_type' => 'percent',
            'set_menu' => 0,
            'branch_id' => 1,
            'colors' => null,
            'popularity_count' => 0,
            'product_type' => 'veg',
            'is_recommended' => 0,
        ]);
    }
}