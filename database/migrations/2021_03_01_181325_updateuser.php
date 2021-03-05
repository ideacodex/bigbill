<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Updateuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            //Imagen de la compañia
            $table->string('file')->nullable();
            //Asignacion de compania por el id de usuario
            $table->integer('user')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('file')->nullable();
            $table->dropColumn('user')->nullable();
        });
       
    }
}
