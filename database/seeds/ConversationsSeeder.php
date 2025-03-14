<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConversationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('conversations')->insert([
            [
                'user_id' => 1,
                'receiver_id' => 2,
                'message' => 'Hello, how can I assist you today?',
                'checked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'receiver_id' => 1,
                'message' => 'I need help with my order.',
                'checked' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}