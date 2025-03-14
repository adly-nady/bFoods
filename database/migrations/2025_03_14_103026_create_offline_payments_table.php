<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflinePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('offline_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->text('payment_info')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 => pending, 1 => approved, 2 => denied');
            $table->timestamps();
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');        
        });
    }

    public function down()
    {
        Schema::dropIfExists('offline_payments');
    }
}