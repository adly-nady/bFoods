<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->text('product_details')->nullable();
            $table->longText('variation')->nullable();
            $table->decimal('discount_on_product', 8, 2)->nullable();
            $table->string('discount_type', 20)->default('amount');
            $table->integer('quantity')->default(1);
            $table->decimal('tax_amount', 8, 2)->default(1.00);
            $table->timestamps();
            $table->string('add_on_ids', 255)->nullable();
            $table->string('variant', 255)->nullable();
            $table->string('add_on_qtys', 255)->nullable();
            $table->string('add_on_taxes', 255)->nullable();
            $table->string('add_on_prices', 255)->nullable();
            $table->decimal('add_on_tax_amount', 8, 2)->default(0.00);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}