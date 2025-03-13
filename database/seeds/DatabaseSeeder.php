<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run($admin_f_name = 'Admin', $admin_l_name = 'User', $admin_email = null, $admin_password = null, $admin_phone = null, $web_name = 'My Business')
    {
        $this->call([
            AddonSettingsSeeder::class,
            AdminRolesSeeder::class,
            BannersSeeder::class,
            BranchesSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            ProductByBranchesSeeder::class,
        ]);

        $this->callWith(AdminSeeder::class, [
            'admin_f_name' => $admin_f_name,
            'admin_l_name' => $admin_l_name,
            'admin_email' => $admin_email,
            'admin_password' => $admin_password,
            'admin_phone' => $admin_phone,
        ]);

        $this->callWith(BusinessSettingsSeeder::class, [
            'web_name' => $web_name,
        ]);
    }
}