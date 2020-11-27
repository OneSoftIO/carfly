<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->boolean('status')->default(true);
            $table->longText('description');
            $table->integer('car_year')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('gearbox')->nullable();
            $table->integer('run')->nullable();
            $table->longText('short_description');
            $table->longText('information')->nullable();
            $table->json('images')->nullable();
            $table->json('terms')->nullable();
            $table->string('meta_name')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
