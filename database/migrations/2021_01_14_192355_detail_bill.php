<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('detail_bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')
            ->references('id')->on('invoice_bills');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')
            ->references('id')->on('products');
            $table->decimal('quantity');
            $table->decimal('unit_price');
            $table->decimal('subtotal');
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
        Schema::dropIfExists('detail_bills');
    }
}
