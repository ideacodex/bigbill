<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->float('price');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies');
            $table->string('quantity_values');
            $table->string('date_values');
            /**Cantidad de ingreso */
            $table->integer('income_amount');
            /**Fecha de ingreso */
            $table->date('date_admission');
            /**Cantidad de egresos */
            $table->integer('amount_expenses')->nullable();
            /**Fecha de egresos */
            $table->date('date_discharge')->nullable();
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
        Schema::dropIfExists('products');
    }
}
