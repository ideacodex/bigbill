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
            $table->string('description');
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
            $table->string('quantity_values');
            $table->string('kind_product');
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
            //familia
            $table->string('family')->nullable();
            //marca
            $table->string('mark')->nullable();
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
        Schema::create('pivote_family', function (Blueprint $table) {
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
        Schema::create('pivote_mark', function (Blueprint $table) {
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
        Schema::dropIfExists('pivote_family');
        Schema::dropIfExists('pivote_mark');
    }
}
