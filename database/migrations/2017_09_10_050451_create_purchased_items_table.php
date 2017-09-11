<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')->unsigned();
            $table->string('package_name', 250);
            $table->string('package_type', 250);
            $table->integer('customer_pax');
            $table->decimal('price', 7, 2);
            $table->string('travel_period', 10);
            $table->date('chosen_travel_date');
            $table->timestamps();
        });

        Schema::table('purchased_items', function($table) {
            $table->foreign('purchase_id')->references('id')->on('purchases')
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
        Schema::dropIfExists('purchased_items');
    }
}
