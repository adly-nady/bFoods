<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->integer('capacity')->default(1);
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('qr_code', 350)->nullable();
            $table->timestamps();

            $table->foreign('branch_id', 'tables_branch_fk')
                  ->references('id')->on('branches')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tables');
    }
}