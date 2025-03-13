<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->decimal('order_amount', 8, 2)->default(0.00);
            $table->string('coupon_discount_title', 255)->nullable();
            $table->string('payment_status', 255)->default('unpaid');
            $table->string('order_status', 255)->default('pending');
            $table->decimal('total_tax_amount', 8, 2)->default(0.00);
            $table->string('payment_method', 30)->nullable();
            $table->string('transaction_reference', 255)->nullable();
            $table->bigInteger('delivery_address_id')->nullable();
            $table->timestamps();
            $table->boolean('checked')->default(0);
            $table->bigInteger('delivery_man_id')->nullable();
            $table->decimal('delivery_charge', 8, 2)->default(0.00);
            $table->text('order_note')->nullable();
            $table->string('coupon_code', 255)->nullable();
            $table->string('order_type', 255)->default('delivery');
            $table->bigInteger('branch_id')->default(1);
            $table->string('callback', 255)->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('delivery_time', 255)->nullable();
            $table->decimal('extra_discount', 8, 2)->default(0.00);
            $table->text('delivery_address')->nullable();
            $table->integer('preparation_time')->nullable();
            $table->bigInteger('table_id')->nullable();
            $table->integer('number_of_people')->nullable();
            $table->bigInteger('table_order_id')->nullable();
            $table->boolean('is_cutlery_required')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}