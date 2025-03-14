<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('The user initiating or involved in the conversation');
            $table->unsignedBigInteger('receiver_id')->nullable()->comment('The user or entity receiving the conversation');
            $table->text('message')->nullable()->comment('The content of the conversation');
            $table->boolean('checked')->default(0)->comment('0 = unread, 1 = read');
            $table->timestamps();

            // Foreign key constraints (optional, adjust based on your needs)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}