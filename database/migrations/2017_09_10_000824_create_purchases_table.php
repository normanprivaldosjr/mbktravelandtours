<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('admin_id')->nullable()->unsigned();
            $table->tinyInteger('purchase_status')->default(0);
            $table->string('bank_name', 150);
            $table->decimal('subtotal', 7, 2);
            $table->decimal('miscellaneous_fee', 7, 2)->default(0);
            $table->decimal('tax', 7, 2);
            $table->decimal('total', 7, 2);
            $table->string('proof_of_purchase', 150)->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
