<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addon_settings', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('key_name', 191)->nullable();
            $table->longText('live_values')->nullable();
            $table->longText('test_values')->nullable();
            $table->string('settings_type', 255)->nullable();
            $table->string('mode', 20)->default('live');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->longText('additional_data')->collation('utf8mb4_bin')->nullable();
        });
        Schema::table('addon_settings', function (Blueprint $table) {
            $table->index('id', 'payment_settings_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addon_settings');
    }
};
