<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('phone_number', 25);
            $table->string('email_address', 150);
            $table->tinyInteger('travel_type')->default(1);
            $table->integer('origin')->unsigned();
            $table->integer('destination')->unsigned();
            $table->integer('drop_off_point')->unsigned()->nullable();
            $table->date('date_departure');
            $table->date('date_return')->nullable();
            $table->date('birthday');
            $table->string('id_number', 25)->nullable();
            $table->tinyInteger('remark')->default(0);
            $table->timestamps();

            
        });

        Schema::table('bus_inquiries', function($table) {
            $table->foreign('origin')->references('id')->on('bus_travel_locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('destination')->references('id')->on('bus_travel_locations')
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
        Schema::dropIfExists('bus_inquiries');
    }
}
