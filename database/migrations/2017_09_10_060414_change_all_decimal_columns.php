<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAllDecimalColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function($table) {
            $table->decimal('subtotal', 11,2)->change();
            $table->decimal('miscellaneous_fee', 11,2)->change();
            $table->decimal('tax', 11,2)->change();
            $table->decimal('total', 11,2)->change();
        });
        Schema::table('purchased_items', function($table) {
            $table->decimal('price', 11,2)->change();
        });
        Schema::table('tour_packages', function($table) {
            $table->decimal('price_starts', 11,2)->change();
        });
        Schema::table('package_types', function($table) {
            $table->decimal('price', 11,2)->change();
        });
        Schema::table('custom_tour_packages', function($table) {
            $table->decimal('min_budget', 11,2)->change();
            $table->decimal('max_budget', 11,2)->change();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function($table) {
            $table->decimal('subtotal', 7,2)->change();
            $table->decimal('miscellaneous_fee', 7,2)->change();
            $table->decimal('tax', 7,2)->change();
            $table->decimal('total', 7,2)->change();
        });
        Schema::table('purchased_items', function($table) {
            $table->decimal('price', 7,2)->change();
        });
        Schema::table('tour_packages', function($table) {
            $table->decimal('price_starts', 7,2)->change();
        });
        Schema::table('package_types', function($table) {
            $table->decimal('price', 7,2)->change();
        });
        Schema::table('custom_tour_packages', function($table) {
            $table->decimal('min_budget', 7,2)->change();
            $table->decimal('max_budget', 7,2)->change();
        });
    }
}
