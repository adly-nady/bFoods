<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('f_name', 100)->nullable();
            $table->string('l_name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('user_type', 100)->nullable()->comment('null for user, kitchen for kitchen user');
            $table->boolean('is_active')->default(1)->comment('1 = active, 0 = inactive');
            $table->string('image', 100)->nullable();
            $table->boolean('is_phone_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->string('email_verification_token', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('cm_firebase_token', 255)->nullable();
            $table->decimal('point', 8, 2)->default(0.00);
            $table->string('temporary_token', 255)->nullable();
            $table->string('login_medium', 15)->nullable();
            $table->decimal('wallet_balance', 24, 3)->default(0.000);
            $table->string('refer_code', 255)->nullable();
            $table->bigInteger('refer_by')->nullable();
            $table->tinyInteger('login_hit_count')->default(0);
            $table->boolean('is_temp_blocked')->default(0);
            $table->timestamp('temp_block_time')->nullable();
            $table->string('language_code', 255)->default('en');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}