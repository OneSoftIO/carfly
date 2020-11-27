<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPostTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts_translation', function (Blueprint $table) {
            $table->string('meta_keywords')->nullable()->after('post_short_content');
            $table->longText('meta_description')->nullable()->after('post_short_content');
            $table->string('meta_name')->nullable()->after('post_short_content');
            $table->dropColumn(['meta_id']);
        });

        Schema::dropIfExists('postmeta');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts_translation', function (Blueprint $table) {
            //
        });
    }
}
