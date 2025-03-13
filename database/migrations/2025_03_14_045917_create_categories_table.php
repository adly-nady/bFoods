<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->nullable();
            $table->bigInteger('parent_id')->default(0);
            $table->integer('position');
            $table->boolean('status')->default(1);
            $table->integer('priority')->default(10);
            $table->timestamps();
            $table->string('image', 255)->default('def.png');
            $table->string('banner_image', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}