<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email_or_phone', 255)->index('password_resets_email_index');
            $table->string('token', 255);
            $table->timestamp('created_at')->nullable();
            $table->string('phone', 255)->nullable();
            $table->tinyInteger('otp_hit_count')->default(0);
            $table->boolean('is_temp_blocked')->default(0);
            $table->timestamp('temp_block_time')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}