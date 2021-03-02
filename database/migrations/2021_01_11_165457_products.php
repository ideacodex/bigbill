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
            //nombre
            $table->string('name');
            //descripcion
            $table->string('description')->nullable();
            //precio
            $table->float('price')->nullable();
            //costo
            $table->float('cost')->nullable();
            //precio especial
            $table->float('special_price')->nullable();
            //precio credito
            $table->float('credit_price')->nullable();
            //compañia
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies');
            //impuesto booleano si:1|no:0
            $table->boolean('tax')->nullable();
            $table->string('quantity_values')->nullable();
            $table->integer('kind_product')->nullable();
            $table->integer('stock')->nullable();
            $table->boolean('active')->nullable();
            //Ingresos anteriores
            $table->integer('income_amount')->nullable();
            /**Nuevos ingresos */
            $table->integer('new_income')->nullable();
            //Ingresos totales
            $table->integer('total_revenue')->nullable();
            /**Cantidad de egresos */
            $table->integer('amount_expenses')->nullable();
            //Dimensiones
            //peso
            $table->string('weight')->nullable();
            //alto
            $table->string('tall')->nullable();
            //ancho
            $table->string('broad')->nullable();
            //profundidad
            $table->string('depth')->nullable();
            //Imagen del producto
            $table->string('file')->nullable();
            //fechas y horas
            $table->timestamps();
        });
        Schema::create('families', function (Blueprint $table) {
            //id
            $table->bigIncrements('id');
            //familia
            $table->string('name');
            //compañia
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies');
            //fechas y horas
            $table->timestamps();
        });
        Schema::create('marks', function (Blueprint $table) {
            //id
            $table->bigIncrements('id');
            //familia
            $table->string('name');
            //compañia
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
                ->references('id')->on('companies');
            //fechas y horas
            $table->timestamps();
        });
        Schema::create('pivote_families', function (Blueprint $table) {
            //id
            $table->bigIncrements('id');
            //familia
            $table->unsignedBigInteger('family_id')->nullable();
            $table->foreign('family_id')
                ->references('id')->on('families');
            //producto id
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                ->references('id')->on('products');
            //fechas y horas
            $table->timestamps();
        });
        Schema::create('pivote_marks', function (Blueprint $table) {
            //id
            $table->bigIncrements('id');
            //marca
            $table->unsignedBigInteger('mark_id')->nullable();
            $table->foreign('mark_id')
                ->references('id')->on('marks');

            //producto id
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                ->references('id')->on('products');
            //fechas y horas
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

        Schema::dropIfExists('families');
        Schema::dropIfExists('marks');
        Schema::dropIfExists('pivote_families');
        Schema::dropIfExists('pivote_marks');
    }
}
