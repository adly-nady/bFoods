<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('time_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('day');
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('time_schedules');
    }
}