<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->dateTime('event_timestamp');
            $table->integer('partner_id');
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->decimal('event_value');
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
        Schema::drop('event');
    }
}
