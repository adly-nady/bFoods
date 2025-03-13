<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('restaurant_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('latitude', 255)->nullable();
            $table->string('longitude', 255)->nullable();
            $table->text('address')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('branch_promotion_status')->default(1);
            $table->timestamps();
            $table->integer('coverage')->default(1);
            $table->string('remember_token', 255)->nullable();
            $table->string('image', 255)->default('def.png');
            $table->string('phone', 25)->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->integer('preparation_time')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branches');
    }
}