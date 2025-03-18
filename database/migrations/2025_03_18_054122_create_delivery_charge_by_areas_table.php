<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_charge_by_areas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->index();
            $table->string('area_name', 255);
            $table->double('delivery_charge')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_charge_by_areas');
    }
};
