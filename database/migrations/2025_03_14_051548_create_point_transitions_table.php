<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTransitionsTable extends Migration
{
    public function up()
    {
        Schema::create('point_transitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->text('description')->nullable();
            $table->string('type', 255)->nullable();
            $table->decimal('amount', 8, 2)->default(0.00);
            $table->timestamps();
            $table->string('transaction_id', 255)->nullable();
            $table->decimal('credit', 24, 3)->default(0.000);
            $table->decimal('debit', 24, 3)->default(0.000);
            $table->string('reference', 191)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('point_transitions');
    }
}