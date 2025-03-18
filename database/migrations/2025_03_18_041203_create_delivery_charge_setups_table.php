<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_charge_setups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->string('delivery_charge_type', 255)->default('distance')->comment('area/distance');
            $table->double('delivery_charge_per_kilometer', 8, 2)->default(0);
            $table->double('minimum_delivery_charge', 8, 2)->default(0);
            $table->double('minimum_distance_for_free_delivery', 8, 2)->default(0);
            $table->double('fixed_delivery_charge', 8, 2)->default(0);
            $table->timestamps();
        });

        // Insert default data
        DB::table('delivery_charge_setups')->insert([
            'id' => 1,
            'branch_id' => 1,
            'delivery_charge_type' => 'fixed',
            'delivery_charge_per_kilometer' => 0,
            'minimum_delivery_charge' => 0,
            'minimum_distance_for_free_delivery' => 0,
            'fixed_delivery_charge' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_charge_setups');
    }
};
