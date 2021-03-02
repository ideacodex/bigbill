<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Shoppings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')
                ->references('id')->on('companies');
            //Tipo de producto
            $table->integer('type_product');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branch_offices');
            //Proveedor
            $table->string('supplier');
            $table->string('ListaPro')->nullable();
            $table->decimal('total');
            $table->string('totalletras')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')
                ->references('id')->on('accounts');
            $table->string('description')->nullable();
            $table->timestamp('date_issue')->nullable();
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
        Schema::dropIfExists('shoppings');
    }
}
