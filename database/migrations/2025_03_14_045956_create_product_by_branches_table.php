<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductByBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('product_by_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->nullable();
            $table->double('price', 8, 2)->default(0.00);
            $table->string('discount_type', 255)->default('percent');
            $table->double('discount', 8, 2)->default(0.00);
            $table->bigInteger('branch_id')->nullable();
            $table->boolean('is_available')->default(1)->comment('0=>not available, 1=>available');
            $table->text('variations')->nullable();
            $table->timestamps();
            $table->string('stock_type', 255)->default('unlimited');
            $table->integer('stock')->default(0);
            $table->integer('sold_quantity')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_by_branches');
    }
}