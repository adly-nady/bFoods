<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftCredentialsTable extends Migration
{
    public function up()
    {
        Schema::create('soft_credentials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 255)->nullable();
            $table->longText('value')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soft_credentials');
    }
}