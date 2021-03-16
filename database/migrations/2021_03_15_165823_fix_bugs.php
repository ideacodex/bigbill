<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixBugs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('delivery_address')->nullable();
        });

        Schema::create('adds', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file')->nullable();
            $table->string('description')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('adds');
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('delivery_address');
        });
    }
}
