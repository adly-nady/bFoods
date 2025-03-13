<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAreasTable extends Migration
{
    public function up()
    {
        Schema::create('order_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('order_areas_order_id_index');
            $table->unsignedBigInteger('branch_id')->index('order_areas_branch_id_index');
            $table->unsignedBigInteger('area_id')->index('order_areas_area_id_index');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_areas');
    }
}