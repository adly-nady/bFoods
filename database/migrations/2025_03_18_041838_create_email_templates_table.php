<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->text('body')->nullable();
            $table->string('background_image', 100)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('button_name', 100)->nullable();
            $table->string('button_url', 255)->nullable();
            $table->string('footer_text', 255)->nullable();
            $table->string('copyright_text', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('email_type', 255)->nullable();
            $table->string('email_template', 255)->nullable();
            $table->boolean('privacy')->default(0);
            $table->boolean('refund')->default(0);
            $table->boolean('cancelation')->default(0);
            $table->boolean('contact')->default(0);
            $table->boolean('facebook')->default(0);
            $table->boolean('instagram')->default(0);
            $table->boolean('twitter')->default(0);
            $table->boolean('linkedin')->default(0);
            $table->boolean('pinterest')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
