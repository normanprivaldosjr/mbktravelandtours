<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            //$table->renameColumn('name', 'first_name');
            $table->string('first_name', 150);
            $table->string('middle_initial', 10)->nullable();
            $table->string('last_name', 150);
            $table->tinyInteger('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('city', 150)->nullable();
            $table->string('province', 150)->nullable();
            $table->string('phone_number', 25)->nullable();
            $table->string('profile_picture', 150)->nullable();
            $table->tinyInteger('link_type')->default(0);
            $table->timestamp('last_activity')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('first_name');
            $table->dropColumn('middle_initial');
            $table->dropColumn('last_name');
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('city');
            $table->dropColumn('province');
            $table->dropColumn('phone_number');
            $table->dropColumn('profile_picture');
            $table->dropColumn('link_type');
            $table->dropColumn('last_activity');
        });
    }
}
