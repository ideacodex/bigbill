<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('nit')->unique();
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();           
        });

        Schema::create('branch_offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('phone')->unique();
            $table->integer('pbx')->nullable();
            $table->string('address');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
            ->references('id')->on('companies');
            $table->timestamps();           
        });

        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedInteger('role_id')->nullable();
            $table->string('name');
            $table->string('lastname');
            $table->integer('phone');         
            $table->integer('nit')->unique();
            $table->string('address');
            $table->boolean('suscription')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('history_company_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')
            ->references('id')->on('companies');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
            ->references('id')->on('branch_offices');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('branch_offices');
        Schema::dropIfExists('companies');
    }
}
