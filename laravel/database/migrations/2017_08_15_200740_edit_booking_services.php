<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditBookingServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking__services', function (Blueprint $table) {
            $table->integer('service_id')->after('order_id');
            $table->string('service_name')->after('service_id');
            $table->float('service_price')->after('service_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_services', function (Blueprint $table) {
            //
        });
    }
}
