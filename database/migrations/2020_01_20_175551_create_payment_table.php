<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->string('codigo',10)->primary();
            $table->string('name')->nullable(true);
            $table->string('email')->nullable(true);
            $table->integer('quantity')->nullable(true);
            $table->float('amount')->nullable(false);
            $table->integer('collection_id')->nullable(true);
            $table->string('collection_status')->nullable(true);
            $table->string('payment_type')->nullable(true);
            $table->string('merchant_order_id')->nullable(true);
            $table->string('preference_id')->nullable(true);
            $table->string('estatus')->nullable(false);
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
        Schema::dropIfExists('payments');
    }
}
