<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {DB::table('admin_roles')->insert([
        'id' => 1,
        'name' => 'Master Admin',
        'module_access' => null,
        'status' => 1,
        'created_at' => '2022-06-07 10:59:59',
        'updated_at' => '2022-06-07 10:59:59',
    ]);
    }
}
