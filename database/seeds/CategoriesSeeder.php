<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Test category',
                'parent_id' => 0,
                'position' => 0,
                'status' => 1,
                'priority' => 10,
                'created_at' => '2023-09-06 08:38:19',
                'updated_at' => '2023-09-06 08:38:19',
                'image' => '2023-09-06-64f83a7bc7308.png',
                'banner_image' => '2023-09-06-64f83a7bc86ec.png',
            ],
            [
                'id' => 2,
                'name' => 'Test Sub Category',
                'parent_id' => 1,
                'position' => 1,
                'status' => 1,
                'priority' => 10,
                'created_at' => '2023-09-06 08:39:46',
                'updated_at' => '2023-09-06 08:39:46',
                'image' => 'def.png',
                'banner_image' => 'def.png',
            ],
        ]);
    }
}