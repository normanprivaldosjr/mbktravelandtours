<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomTourPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_tour_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('phone_number', 25);
            $table->string('email_address', 150);
            $table->tinyInteger('no_of_pax')->default(1);
            $table->tinyInteger('no_of_days')->default(1);
            $table->tinyInteger('no_of_nights')->default(1);
            $table->decimal('min_budget', 7, 2);
            $table->decimal('max_budget', 7, 2);
            $table->string('location', 250);
            $table->date('birthday');
            $table->tinyInteger('remark')->default(0);
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
        Schema::dropIfExists('custom_tour_packages');
    }
}
