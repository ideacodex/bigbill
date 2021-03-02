<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Updatetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //Imagen del usuario
            $table->string('file')->nullable();
            //Permisos de Trabajo
            $table->string('work_permits')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //Imagen del usuario
            $table->dropColumn('file');
            //Permisos de Trabajo
            $table->string('work_permits');
        });
    }
}
