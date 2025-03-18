<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('country', 255)->nullable();
            $table->string('currency_code', 255)->nullable();
            $table->string('currency_symbol', 255)->nullable();
            $table->decimal('exchange_rate', 8, 2)->nullable();
            $table->timestamps();
        });

        // Insert default currencies
        DB::table('currencies')->insert([
            ['id' => 1, 'country' => 'US Dollar', 'currency_code' => 'USD', 'currency_symbol' => '$', 'exchange_rate' => 1.00, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'country' => 'Canadian Dollar', 'currency_code' => 'CAD', 'currency_symbol' => 'CA$', 'exchange_rate' => 1.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};