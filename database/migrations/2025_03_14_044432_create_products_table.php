<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->text('variations')->nullable();
            $table->string('add_ons', 255)->nullable();
            $table->decimal('tax', 8, 2)->default(0.00);
            $table->time('available_time_starts')->nullable();
            $table->time('available_time_ends')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->string('attributes', 255)->nullable();
            $table->string('category_ids', 255)->nullable();
            $table->text('choice_options')->nullable();
            $table->decimal('discount', 8, 2)->default(0.00);
            $table->string('discount_type', 20)->default('percent');
            $table->string('tax_type', 20)->default('percent');
            $table->boolean('set_menu')->default(0);
            $table->unsignedBigInteger('branch_id')->default(1);
            $table->text('colors')->nullable();
            $table->integer('popularity_count')->default(0);
            $table->string('product_type', 255)->nullable()->comment('veg, non_veg');
            $table->boolean('is_recommended')->default(0);

            $table->foreign('branch_id', 'products_branch_id_fk')
                  ->references('id')->on('branches')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}