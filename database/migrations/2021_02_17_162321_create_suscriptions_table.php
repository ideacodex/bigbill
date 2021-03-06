<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->integer('type_plan');
            $table->timestamp('date_active')->nullable();
            $table->timestamp('date_expiration')->nullable();
            $table->boolean('active');
            $table->timestamps();
        });

        Schema::create('payment_suscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('suscription_id');
            $table->foreign('suscription_id')
                ->references('id')->on('suscriptions');
            $table->string('comments');
            $table->float('amount');
            $table->integer('suscription_time');
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
        Schema::dropIfExists('payment_suscriptions');
        Schema::dropIfExists('suscriptions');
    }
}
