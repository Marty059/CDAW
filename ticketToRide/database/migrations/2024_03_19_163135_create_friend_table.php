<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend', function (Blueprint $table) {
            $table->integer('id_user_1');
            $table->foreign('id_user_1')->references('id_user')->on('user');
            $table->integer('id_user_2');
            $table->foreign('id_user_2')->references('id_user')->on('user');
            $table->primary(['id_user_1', 'id_user_2']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend');
    }
}
