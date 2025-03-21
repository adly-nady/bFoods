<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('transaction_id', 255);
            $table->decimal('credit', 24, 3)->default(0.000);
            $table->decimal('debit', 24, 3)->default(0.000);
            $table->decimal('admin_bonus', 24, 3)->default(0.000);
            $table->decimal('balance', 24, 3)->default(0.000);
            $table->string('transaction_type', 191)->nullable();
            $table->string('reference', 191)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
}