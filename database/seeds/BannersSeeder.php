<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersSeeder extends Seeder
{
    public function run()
    {
        DB::table('banners')->insert([
            'id' => 1,
            'title' => 'Test Banner',
            'image' => '2023-09-06-64f83b496eb2a.png',
            'product_id' => null,
            'status' => 1,
            'created_at' => '2023-09-06 08:41:45',
            'updated_at' => '2023-09-06 08:41:45',
            'category_id' => 1,
        ]);
    }
}