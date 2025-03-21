<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->bigInteger('user_id');
            $table->mediumText('comment')->nullable();
            $table->string('attachment', 255)->nullable();
            $table->integer('rating')->default(0);
            $table->timestamps();
            $table->bigInteger('order_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}