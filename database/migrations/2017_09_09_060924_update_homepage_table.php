<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHomepageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homepage', function($table) {
            //$table->renameColumn('name', 'first_name');
            $table->string('address', 250)->nullable();
            $table->string('email_address', 150)->nullable();
            $table->string('phone_number', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homepage', function($table) {
            $table->dropColumn('address');
            $table->dropColumn('email_address');
            $table->dropColumn('phone_number');
        });
    }
}
