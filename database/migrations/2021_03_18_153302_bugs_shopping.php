<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BugsShopping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->nullable();
        });

        Schema::table('shoppings', function (Blueprint $table) {
            $table->string('active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoppings', function (Blueprint $table) {
            $table->dropColumn('active')->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sku')->nullable();
        });
    }
}
