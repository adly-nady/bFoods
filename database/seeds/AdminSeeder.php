<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run($admin_f_name = 'Admin', $admin_l_name = 'User', $admin_email, $admin_password, $admin_phone)
    {
        DB::table('admins')->insert([
            'f_name' => $admin_f_name??"adly",
            'l_name' => $admin_l_name??"nady",
            'email' => $admin_email??"admin@admin.com",
            'password' => bcrypt($admin_password??"admin@admin.com"),
            'phone' => $admin_phone??"11111111111",
            'admin_role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'identity_number' => '123456',
            'identity_type' => 'passport',
            'identity_image' => 'default.jpg',
        ]);
    }
}