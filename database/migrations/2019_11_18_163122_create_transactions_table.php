<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('wallet_id')->unsigned();
            $table->bigInteger('to_wallet_id')->unsigned();
            $table->integer('type')->unsigned()->nullable(false);
            $table->string('status', 100);
            $table->bigInteger('currency_id')->unsigned()->nullable(false);
            $table->double('amount', 16, 4)->unsigned()->nullable(false)->default(0);
            $table->double('default_currency_amount', 16, 4)->unsigned()->nullable(false)->default(0);

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
        Schema::dropIfExists('transactions');
    }
}
