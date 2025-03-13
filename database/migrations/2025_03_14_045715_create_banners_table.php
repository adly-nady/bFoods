<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->nullable();
            $table->string('image', 100)->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->bigInteger('category_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners');
    }
}