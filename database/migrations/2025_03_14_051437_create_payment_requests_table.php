<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('payer_id', 64)->nullable();
            $table->string('receiver_id', 64)->nullable();
            $table->decimal('payment_amount', 24, 2)->default(0.00);
            $table->string('gateway_callback_url', 191)->nullable();
            $table->string('success_hook', 100)->nullable();
            $table->string('failure_hook', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('currency_code', 20)->default('USD');
            $table->string('payment_method', 50)->nullable();
            $table->longText('additional_data')->nullable()->charset('utf8mb4')->collation('utf8mb4_bin');
            $table->boolean('is_paid')->default(0);
            $table->timestamps();
            $table->longText('payer_information')->nullable()->charset('utf8mb4')->collation('utf8mb4_bin');
            $table->string('external_redirect_link', 255)->nullable();
            $table->longText('receiver_information')->nullable()->charset('utf8mb4')->collation('utf8mb4_bin');
            $table->string('attribute_id', 64)->nullable();
            $table->string('attribute', 255)->nullable();
            $table->string('payment_platform', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_requests');
    }
}