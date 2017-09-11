<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id')->unsigned();
            $table->string('type_name', 150);
            $table->integer('pax_per_room');
            $table->decimal('price', 7, 2);
            $table->text('help_info');
            $table->timestamps();
            
        });

        Schema::table('package_types', function($table) {
            $table->foreign('package_id')->references('id')->on('tour_packages')
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
        Schema::dropIfExists('package_types');
    }
}
