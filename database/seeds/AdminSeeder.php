<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run($admin_f_name = 'Admin', $admin_l_name = 'User', $admin_email, $admin_password, $admin_phone)
    {
        DB::table('admins')->insert([
            'f_name' => $admin_f_name,
            'l_name' => $admin_l_name,
            'email' => $admin_email,
            'password' => bcrypt($admin_password),
            'phone' => $admin_phone,
            'admin_role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'identity_number' => '123456',
            'identity_type' => 'passport',
            'identity_image' => 'default.jpg',
        ]);
    }
}