<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('tour_package_id')->unsigned();
            $table->integer('package_type_id')->unsigned();
            $table->integer('no_of_pax');
            $table->timestamps();
            
        });

        Schema::table('cart_items', function($table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tour_package_id')->references('id')->on('tour_packages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('package_type_id')->references('id')->on('package_types')
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
        Schema::dropIfExists('cart_items');
    }
}
