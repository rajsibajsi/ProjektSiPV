<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_coins', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_user')->nullable(); /*Foreign key for user*/
            $table->integer('id_coin')->nullable(); /*Foreign key for coin name and propreties*/
            $table->integer('number_of_coins')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_coins');
    }
}
