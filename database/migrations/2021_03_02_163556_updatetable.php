<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Updatetable extends Migration
{
    //maria
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

        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('company_id');
           
        });

        Schema::table('users', function (Blueprint $table) {
            //Imagen del usuario
            $table->dropColumn('file');
            //Permisos de Trabajo
            $table->dropColumn('work_permits');
        });
    }
}
