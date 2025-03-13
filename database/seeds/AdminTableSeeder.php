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
        DB::table('addon_settings')->insert([
            [
                'id' => '070c6bbd-d777-11ed-96f4-0c7a158e4469',
                'key_name' => 'twilio',
                'live_values' => '{"gateway":"twilio","mode":"live","status":0,"sid":null,"messaging_service_sid":null,"token":null,"from":null,"otp_template":null}',
                'test_values' => '{"gateway":"twilio","mode":"live","status":0,"sid":null,"messaging_service_sid":null,"token":null,"from":null,"otp_template":null}',
                'settings_type' => 'sms_config',
                'mode' => 'live',
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => '2023-08-12 07:01:29',
                'additional_data' => null,
            ],
            [
                'id' => '070c766c-d777-11ed-96f4-0c7a158e4469',
                'key_name' => '2factor',
                'live_values' => '{"gateway":"2factor","mode":"live","status":"0","api_key":null}',
                'test_values' => '{"gateway":"2factor","mode":"live","status":"0","api_key":null}',
                'settings_type' => 'sms_config',
                'mode' => 'live',
                'is_active' => 1,
                'created_at' => null,
                'updated_at' => '2023-08-12 07:01:36',
                'additional_data' => null,
            ],
            // Add remaining addon_settings entries here (full list truncated for brevity)
            [
                'id' => 'f149cd9c-d8ea-11ed-8249-0c7a158e4469',
                'key_name' => '019_sms',
                'live_values' => '{"gateway":"019_sms","mode":"live","status":0,"password":"","username":"","username_for_token":"","sender":"","otp_template":""}',
                'test_values' => '{"gateway":"019_sms","mode":"live","status":0,"password":"","username":"","username_for_token":"","sender":"","otp_template":""}',
                'settings_type' => 'sms_config',
                'mode' => 'live',
                'is_active' => 0,
                'created_at' => null,
                'updated_at' => null,
                'additional_data' => null,
            ],
        ]);

    }
}
