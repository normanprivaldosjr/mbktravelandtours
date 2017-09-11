<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropOffPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drop_off_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('origin')->unsigned();
            $table->integer('destination')->unsigned();
            $table->integer('drop_off_point')->unsigned();
            $table->string('drop_off_point_name', 250);
            $table->timestamps();
        });

        Schema::table('drop_off_points', function($table) {
            $table->foreign('origin')->references('id')->on('bus_travel_locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('destination')->references('id')->on('bus_travel_locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('drop_off_point')->references('id')->on('bus_travel_locations')
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
        Schema::dropIfExists('drop_off_points');
    }
}
