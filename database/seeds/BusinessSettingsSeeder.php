<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSettingsSeeder extends Seeder
{
    public function run($web_name = 'My Business')
    {
        $settings = [
            ['id' => 1, 'key' => 'restaurant_open_time', 'value' => '07:11', 'created_at' => '2021-01-06 05:55:51', 'updated_at' => '2021-01-06 05:55:51'],
            ['id' => 2, 'key' => 'restaurant_close_time', 'value' => '01:20', 'created_at' => null, 'updated_at' => null],
            ['id' => 3, 'key' => 'restaurant_name', 'value' => $web_name, 'created_at' => null, 'updated_at' => null],
            ['id' => 4, 'key' => 'currency', 'value' => 'USD', 'created_at' => null, 'updated_at' => null],
            ['id' => 5, 'key' => 'logo', 'value' => '2021-05-29-60b1f342a8631.png', 'created_at' => null, 'updated_at' => null],
            // Add remaining business_settings entries here (full list truncated for brevity)
            ['id' => 108, 'key' => 'admin_order_notification_type', 'value' => 'manual', 'created_at' => null, 'updated_at' => null],
        ];

        DB::table('business_settings')->insert($settings);
    }
}