<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletBonusesTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_bonuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('description', 255)->nullable();
            $table->string('bonus_type', 255);
            $table->double('bonus_amount', 23, 2)->default(0.00);
            $table->double('minimum_add_amount', 23, 2)->default(0.00);
            $table->double('maximum_bonus_amount', 23, 2)->default(0.00);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_bonuses');
    }
}