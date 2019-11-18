<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->string('surname')->nullable();
			$table->string('date_of_birth')->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('phone_number')->nullable();
			$table->string('address')->nullable();
			$table->string('country')->nullable();
			$table->string('trading_account_number')->nullable();
			$table->string('balance')->nullable();
			$table->string('open_trades')->nullable();
			$table->string('close_trades')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
