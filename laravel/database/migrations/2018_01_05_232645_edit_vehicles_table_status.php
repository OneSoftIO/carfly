<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditVehiclesTableStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('slug');
        });

        Schema::table('vehicles_translation', function (Blueprint $table) {
            $table->dropColumn(['status']);
            $table->integer('meta_id')->nullable()->change();
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
