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
        Schema::create('account_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')
                ->references('id')->on('account_types');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->integer('phone');
            $table->string('email');
            $table->integer('nit');
            $table->timestamps();
        });

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
            $table->integer('acquisition');
            $table->boolean('active')->nullable();
            $table->string('ListaPro')->nullable();
            $table->decimal('total');
            $table->string('totalletras')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')
                ->references('id')->on('accounts');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('date_issue');
            $table->timestamp('expiration_date');
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
        Schema::dropIfExists('customers');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('account_types');
    }
}
