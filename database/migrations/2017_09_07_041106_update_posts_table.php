<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostsTable extends Migration
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
            $table->string('title', 150)->change();
            $table->string('author', 150);
            $table->string('meta_description', 160);
            $table->text('meta_keys');
            $table->string('slug')->nullable(false)->change();
            $table->string('slug')->unique()->change();
            $table->integer('user_id')->unsigned()->change();
        });

        Schema::table('posts', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
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
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_keys');
            $table->dropColumn('author');
        });
    }
}
