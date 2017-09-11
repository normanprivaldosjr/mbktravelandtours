<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand', 150);
            $table->string('model', 150);
            $table->integer('no_of_seats');
            $table->text('description');
            $table->string('van_image', 100);
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
        Schema::dropIfExists('vans');
    }
}
