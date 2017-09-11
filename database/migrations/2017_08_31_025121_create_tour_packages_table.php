<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug')->unique();
            $table->string('package_image', 100);
            $table->tinyInteger('no_of_days');
            $table->tinyInteger('no_of_nights');
            $table->text('package_description');
            $table->date('selling_day_start');
            $table->date('selling_day_end');
            $table->date('travel_day_start');
            $table->date('travel_day_end');
            $table->tinyInteger('no_of_pax')->default('1');
            $table->decimal('price', 7, 2);
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->tinyInteger('destination');
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
        Schema::dropIfExists('tour_packages');
    }
}
