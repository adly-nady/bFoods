<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesSeeder extends Seeder
{
    public function run()
    {
        DB::table('branches')->insert([
            'id' => 1,
            'restaurant_id' => null,
            'name' => 'Main Branch',
            'email' => 'newb@gmail.com',
            'password' => '$2y$10$xNJZTpZLADt4kQbSXMp7fui.9Pf55nJ604iY.QRCzHauae9VMzpeS',
            'latitude' => '22.848823',
            'longitude' => '91.390306',
            'address' => 'lorem ipsum dollar',
            'status' => 1,
            'branch_promotion_status' => 1,
            'created_at' => '2021-02-24 09:45:49',
            'updated_at' => '2024-05-29 10:42:11',
            'coverage' => 50,
            'remember_token' => null,
            'image' => '2023-09-06-64f83ba9c1747.png',
            'phone' => '+8801100000000',
            'cover_image' => '2023-09-06-64f83ba9c1a17.png',
            'preparation_time' => 30,
        ]);
    }
}