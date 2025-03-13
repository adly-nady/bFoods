<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('table_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('table_id');
            $table->string('branch_table_token', 255);
            $table->string('branch_table_token_is_expired', 255)->default('1');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('table_orders');
    }
}