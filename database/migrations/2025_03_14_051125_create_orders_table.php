<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id'); // bigint UNSIGNED NOT NULL
            $table->bigInteger('user_id')->nullable(); // bigint DEFAULT NULL
            $table->integer('is_guest')->default(0); // int NOT NULL DEFAULT '0'
            $table->decimal('order_amount', 8, 2)->default(0.00); // decimal(8,2) NOT NULL DEFAULT '0.00'
            $table->decimal('coupon_discount_amount', 8, 2)->default(0.00); // decimal(8,2) NOT NULL DEFAULT '0.00'
            $table->string('coupon_discount_title', 255)->nullable(); // varchar(255) DEFAULT NULL
            $table->string('payment_status', 255)->default('unpaid'); // varchar(255) NOT NULL DEFAULT 'unpaid'
            $table->string('order_status', 255)->default('pending'); // varchar(255) NOT NULL DEFAULT 'pending'
            $table->decimal('total_tax_amount', 8, 2)->default(0.00); // decimal(8,2) NOT NULL DEFAULT '0.00'
            $table->string('payment_method', 30)->nullable(); // varchar(30) DEFAULT NULL
            $table->string('transaction_reference', 255)->nullable(); // varchar(255) DEFAULT NULL
            $table->bigInteger('delivery_address_id')->nullable(); // bigint DEFAULT NULL
            $table->timestamps(); // created_at and updated_at (timestamp NULL DEFAULT NULL)
            $table->tinyInteger('checked')->default(0); // tinyint(1) NOT NULL DEFAULT '0'
            $table->bigInteger('delivery_man_id')->nullable(); // bigint DEFAULT NULL
            $table->decimal('delivery_charge', 8, 2)->default(0.00); // decimal(8,2) NOT NULL DEFAULT '0.00'
            $table->text('order_note')->nullable(); // text DEFAULT NULL
            $table->string('coupon_code', 255)->nullable(); // varchar(255) DEFAULT NULL
            $table->string('order_type', 255)->default('delivery'); // varchar(255) NOT NULL DEFAULT 'delivery'
            $table->bigInteger('branch_id')->default(1); // bigint NOT NULL DEFAULT '1'
            $table->string('callback', 255)->nullable(); // varchar(255) DEFAULT NULL
            $table->date('delivery_date')->nullable(); // date DEFAULT NULL
            $table->string('delivery_time', 255)->nullable(); // varchar(255) DEFAULT NULL
            $table->decimal('extra_discount', 8, 2)->default(0.00); // decimal(8,2) NOT NULL DEFAULT '0.00'
            $table->text('delivery_address')->nullable(); // text DEFAULT NULL
            $table->integer('preparation_time')->nullable(); // int DEFAULT NULL
            $table->bigInteger('table_id')->nullable(); // bigint DEFAULT NULL
            $table->integer('number_of_people')->nullable(); // int DEFAULT NULL
            $table->bigInteger('table_order_id')->nullable(); // bigint DEFAULT NULL
            $table->tinyInteger('is_cutlery_required')->default(0); // tinyint NOT NULL DEFAULT '0'

            // Optional Foreign Key Constraints (uncomment if needed)
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('delivery_address_id')->references('id')->on('delivery_addresses')->onDelete('set null');
            // $table->foreign('delivery_man_id')->references('id')->on('delivery_men')->onDelete('set null');
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict');
            // $table->foreign('table_id')->references('id')->on('tables')->onDelete('set null');
            // $table->foreign('table_order_id')->references('id')->on('table_orders')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}