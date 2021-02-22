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
            //familia
            $table->string('family')->nullable();
            //marca
            $table->string('mark')->nullable();
            //familia
            $table->string('product_dimensions')->nullable();
            //Imagen del producto
            $table->string('file')->nullable();
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
