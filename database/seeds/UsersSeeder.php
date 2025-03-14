<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'f_name' => 'John',
                'l_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'user_type' => null,
                'is_active' => 1,
                'image' => null,
                'is_phone_verified' => 0,
                'email_verified_at' => null,
                'password' => bcrypt('password123'),
                'phone' => '+8801111111111',
                'cm_firebase_token' => null,
                'point' => 0.00,
                'temporary_token' => null,
                'login_medium' => null,
                'wallet_balance' => 0.000,
                'refer_code' => null,
                'refer_by' => null,
                'login_hit_count' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => null,
                'language_code' => 'en',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'f_name' => 'Jane',
                'l_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'user_type' => null,
                'is_active' => 1,
                'image' => null,
                'is_phone_verified' => 0,
                'email_verified_at' => null,
                'password' => bcrypt('password123'),
                'phone' => '+8802222222222',
                'cm_firebase_token' => null,
                'point' => 0.00,
                'temporary_token' => null,
                'login_medium' => null,
                'wallet_balance' => 0.000,
                'refer_code' => null,
                'refer_by' => null,
                'login_hit_count' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => null,
                'language_code' => 'en',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}