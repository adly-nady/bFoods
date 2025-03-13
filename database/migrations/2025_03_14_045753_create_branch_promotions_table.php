<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchPromotionsTable extends Migration
{
    public function up()
    {
        Schema::create('branch_promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('branch_id');
            $table->string('promotion_type', 255)->nullable();
            $table->string('promotion_name', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branch_promotions');
    }
}