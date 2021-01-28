<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BinnacleBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BinacleBill', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('id_bill');
            $table->integer('total');
            $table->integer('new_total');
            $table->string('usuario');
            $table->date('fecha');
            $table->string('accion');
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
        Schema::dropIfExists('BinacleBill');
    }
}
