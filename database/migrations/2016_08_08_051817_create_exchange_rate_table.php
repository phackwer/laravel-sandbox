<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->date('rate_start_date');
            $table->date('rate_end_date');
            $table->decimal('rate_value');
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
        Schema::drop('exchange_rate');
    }
}
