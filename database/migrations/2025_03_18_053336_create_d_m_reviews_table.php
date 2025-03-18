<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('d_m_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('delivery_man_id')->index();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('order_id')->index();
            $table->mediumText('comment')->nullable();
            $table->string('attachment', 255)->nullable();
            $table->integer('rating')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('d_m_reviews');
    }
};
