<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang');
            $table->integer('term_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('slug');
            $table->string('meta_name')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->dropColumn(['name', 'description', 'slug', 'meta_name', 'meta_description', 'meta_keywords']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_translations');
    }
}
