<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('phone_number', 25);
            $table->string('email_address');
            $table->tinyInteger('flight_type')->default(1);
            $table->tinyInteger('flight_route')->default(1);
            $table->integer('location_from')->unsigned();
            $table->integer('location_to')->unsigned();
            $table->date('date_departure');
            $table->date('date_return')->nullable();
            $table->date('birthday');
            $table->integer('adult_no');
            $table->integer('child_no');
            $table->integer('infant_no');
            $table->tinyInteger('remark')->default(0);
            $table->timestamps();

            
        });

        Schema::table('flight_inquiries', function($table) {
            $table->foreign('location_from')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('location_to')->references('id')->on('locations')
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
        Schema::dropIfExists('flight_inquiries');
    }
}
