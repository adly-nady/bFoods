<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneVerificationsTable extends Migration
{
    public function up()
    {
        Schema::create('phone_verifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone', 255)->nullable();
            $table->string('token', 255)->nullable();
            $table->timestamps();
            $table->tinyInteger('otp_hit_count')->default(0);
            $table->boolean('is_temp_blocked')->default(0);
            $table->timestamp('temp_block_time')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phone_verifications');
    }
}