<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeliveryHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('order_delivery_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('delivery_man_id')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('start_location', 255)->nullable();
            $table->string('end_location', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_delivery_histories');
    }
}