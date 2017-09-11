<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLocationIdOfHotelInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_reservation_inquiries', function($table) {
            $table->dropForeign('hotel_reservation_inquiries_location_id_foreign');
        });
        Schema::table('hotel_reservation_inquiries', function($table) {
            $table->string('location_name', 250)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_reservation_inquiries', function($table) {
            $table->integer('location_id')->change();
        });
        Schema::table('hotel_reservation_inquiries', function($table) {
            $table->foreign('location_id')->references('id')->on('hotel_locations')
                ->onUpdate('cascade')->onDelete('cascade');
       });
    }
}
