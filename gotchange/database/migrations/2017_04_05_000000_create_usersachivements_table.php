<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAchivementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_achivements', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_user')->nullable(); /*Foreign key for user*/
            $table->integer('id_achivement')->nullable(); /*Foreign key for achivement*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_achivements');
    }
}
