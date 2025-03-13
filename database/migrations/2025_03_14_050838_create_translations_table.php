<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('translationable_type', 255);
            $table->unsignedBigInteger('translationable_id')->index('translations_translationable_id_index');
            $table->string('locale', 255)->index('translations_locale_index');
            $table->string('key', 255)->nullable();
            $table->text('value')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('translations');
    }
}