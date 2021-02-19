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
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('tax');
            $table->float('exchange_rate');//tasa de cambio del dolar
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->float('price');
            $table->float('cost')->nullable();
            $table->float('special_price')->nullable();
            $table->float('credit_price')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies');
            $table->boolean('tax')->nullable();
            $table->string('quantity_values');
            $table->integer('kind_product');
            $table->integer('stock');
            $table->boolean('active');
            //Ingresos anteriores
            $table->integer('income_amount');
            /**Nuevos ingresos */
            $table->integer('new_income');
            //Ingresos totales
            $table->integer('total_revenue');
            /**Cantidad de egresos */
            $table->integer('amount_expenses')->nullable();
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
        Schema::dropIfExists('settings');
        Schema::dropIfExists('products');
    }
}
