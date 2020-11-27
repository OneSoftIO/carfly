<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id');
            $table->string('lang');
            $table->integer('meta_id');
            $table->boolean('status')->default(1);
            $table->longText('description');
            $table->longText('short_description');
            $table->longText('information')->nullable();
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['status', 'description', 'short_description', 'information', 'meta_name', 'meta_description', 'meta_keywords']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_translations');
    }
}
