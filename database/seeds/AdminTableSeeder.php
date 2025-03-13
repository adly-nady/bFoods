<?php

use App\Models\AddonSetting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'id' => 1,
            'f_name' => 'Master Admin',
            'l_name' => 'Khandakar',
            'phone' => '01759412381',
            'email' => 'admin@admin.com',
            'image' => 'def.png',
            'password' => bcrypt("admin@admin.com"),
            'remember_token' =>Str::random(10),
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('business_settings')->insert([
            'id' => 1,
            'key' => 'fav_icon',
            'value' => 'fav_icon',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        DB::table('business_settings')->insert([
            'id' => 2,
            'key' => 'logo',
            'value' => 'logo',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        
        $addonSettings = [
            [
                'id' => '070c6bbd-d777-11ed-96f4-0c7a158e4469',
                'key_name' => 'twilio',
                'live_values' => '{"gateway":"twilio","mode":"live","status":"0","sid":"data","messaging_service_sid":"data","token":"data","from":"data","otp_template":"data"}',
                'test_values' => '{"gateway":"twilio","mode":"live","status":"0","sid":"data","messaging_service_sid":"data","token":"data","from":"data","otp_template":"data"}',
                'settings_type' => 'sms_config',
                'mode' => 'live',
                'is_active' => 0,
                'created_at' => null,
                'updated_at' => Carbon::parse('2023-08-12 07:01:29'),
                'additional_data' => null,
            ],
            // ... Repeat for each entry in the SQL dump
            // Example for the second entry:
            [
                'id' => '070c766c-d777-11ed-96f4-0c7a158e4469',
                'key_name' => '2factor',
                'live_values' => '{"gateway":"2factor","mode":"live","status":"0","api_key":"data"}',
                'test_values' => '{"gateway":"2factor","mode":"live","status":"0","api_key":"data"}',
                'settings_type' => 'sms_config',
                'mode' => 'live',
                'is_active' => 0,
                'created_at' => null,
                'updated_at' => Carbon::parse('2023-08-12 07:01:36'),
                'additional_data' => null,
            ],
            // Continue adding all remaining entries similarly
        ];

        foreach ($addonSettings as $setting) {
            AddonSetting::updateOrCreate(['id' => $setting['id']], $setting);
        }

    }
}
