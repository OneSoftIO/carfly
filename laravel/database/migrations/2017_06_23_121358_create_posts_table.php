<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_author')->references('id')->on('users');
            $table->string('post_title');
            $table->string('slug');
            $table->boolean('status')->default(false);
            $table->longText('post_content');
            $table->longText('post_short_content')->nullable();
            $table->string('post_type');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('postmeta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->references('id')->on('posts');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
