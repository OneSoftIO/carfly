<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTermTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_terms_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('term_id');
            $table->string('lang');
            $table->string('name');
            $table->longText('info')->nullable();

        });

        Schema::table('vehicles_terms', function(Blueprint $table){
           $table->dropColumn(['name', 'info']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_term_translations');
    }
}
