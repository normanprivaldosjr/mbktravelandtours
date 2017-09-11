<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVanInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_rental_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('van_id')->unsigned();
            $table->string('name', 255);
            $table->string('phone_number', 25);
            $table->string('email_address', 150);
            $table->string('location_from', 250);
            $table->string('location_to', 250);
            $table->date('rental_day_start');
            $table->date('rental_day_end');
            $table->date('birthday');
            $table->tinyInteger('remark')->default(0);
            $table->timestamps();

            
        });

        Schema::table('van_rental_inquiries', function($table) {
            $table->foreign('van_id')->references('id')->on('vans')
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
        Schema::dropIfExists('van_rental_inquiries');
    }
}
