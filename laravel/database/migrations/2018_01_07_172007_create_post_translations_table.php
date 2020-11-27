<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->string('lang');
            $table->integer('meta_id')->nullable();
            $table->string('post_title');
            $table->string('slug');
            $table->longText('post_content');
            $table->longText('post_short_content')->nullable();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['post_title', 'slug', 'post_content', 'post_short_content']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
    }
}
