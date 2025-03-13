<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('order_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('delivery_man_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->decimal('order_amount', 8, 2)->default(0.00);
            $table->string('received_by', 255)->nullable();
            $table->decimal('delivery_charge', 8, 2)->default(0.00);
            $table->decimal('original_delivery_charge', 8, 2)->default(0.00);
            $table->decimal('tax', 8, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_transactions');
    }
}