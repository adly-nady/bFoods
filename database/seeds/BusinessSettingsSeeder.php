<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSettingsSeeder extends Seeder
{
    public function run($web_name = 'My Business')
    {
        $settings = [
            [ 'key' => 'restaurant_open_time', 'value' => '07:11', 'created_at' => '2021-01-06 05:55:51', 'updated_at' => '2021-01-06 05:55:51'],
            [ 'key' => 'restaurant_close_time', 'value' => '01:20', 'created_at' => null, 'updated_at' => null],
            [ 'key' => 'restaurant_name', 'value' => $web_name, 'created_at' => null, 'updated_at' => null],
            [ 'key' => 'currency', 'value' => 'USD', 'created_at' => null, 'updated_at' => null],
            [ 'key' => 'logo', 'value' => '2021-05-29-60b1f342a8631.png', 'created_at' => null, 'updated_at' => null],
            // Add remaining business_settings entries here if needed
            [ 'key' => 'admin_order_notification_type', 'value' => 'manual', 'created_at' => null, 'updated_at' => null],
        ];

        DB::table('business_settings')->insert($settings);
    }
}