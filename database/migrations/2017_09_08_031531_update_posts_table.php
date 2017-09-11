<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostsTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function($table) {
            //$table->renameColumn('name', 'first_name');
            $table->integer('featured_img')->unsigned();
        });

        Schema::table('posts', function($table) {
            $table->foreign('featured_img')->references('id')->on('medias');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table) {
            $table->dropColumn('featured_img');
        });
    }
}
