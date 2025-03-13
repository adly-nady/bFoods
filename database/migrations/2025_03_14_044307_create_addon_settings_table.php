<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('addon_settings', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('key_name', 191)->nullable();
            $table->longText('live_values')->nullable();
            $table->longText('test_values')->nullable();
            $table->string('settings_type', 255)->nullable();
            $table->string('mode', 20)->default('live');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->longText('additional_data')->nullable()->charset('utf8mb4')->collation('utf8mb4_bin');
        });
    }

    public function down()
    {
        Schema::dropIfExists('addon_settings');
    }
}