<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')
                ->references('id')->on('companies');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branch_offices');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                ->references('id')->on('customers');
            $table->decimal('iva')->nullable();
            $table->string('acquisition');
            $table->boolean('active')->nullable();
            $table->string('ListaPro')->nullable();
            $table->decimal('total');
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
        Schema::dropIfExists('invoice_bills');
    }
}
