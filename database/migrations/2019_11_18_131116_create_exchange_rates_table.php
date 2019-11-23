<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('currency_id')->unsigned();
            //$table->integer('currency_id')->unsigned();
            $table->foreign('currency_id')->references('id')->on('currencies');
            //Zimbabve dollar is rate 367.2343 maybe some other currency even lower for Now I will just use 6.4 (as Double of Zimbabwean Dollar) as maximum
            //https://www.xe.com/currencyconverter/convert/?Amount=1&From=USD&To=ZWD
            //Normaly somebody responsible for this should provide to programmer MAX value of rate.
            $table->double('rate', 10, 4)->nullable(false);
            $table->timestamp('date')->nullable();
            $table->boolean('default')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}
