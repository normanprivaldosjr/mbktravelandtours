<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelReservationInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_reservation_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id')->unsigned();
            $table->string('name', 255);
            $table->string('phone_number', 25);
            $table->string('email_address', 150);
            $table->date('birthday');
            $table->integer('adult_no')->default(1);
            $table->integer('child_no')->default(0);
            $table->integer('no_of_rooms')->default(0);
            $table->date('check_in');
            $table->date('check_out');
            $table->tinyInteger('remark')->default(0);
            $table->tinyInteger('for_work')->default(0);
            $table->timestamps();
            
        });

        Schema::table('hotel_reservation_inquiries', function($table) {
            $table->foreign('location_id')->references('id')->on('hotel_locations')
                ->onUpdate('cascade')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_reservation_inquiries');
    }
}
