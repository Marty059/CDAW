<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJouerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jouer', function (Blueprint $table) {
            $table->integer('id_lobby');
            $table->foreign('id_lobby')->references('id_lobby')->on('lobby')->onDelete('cascade');
            $table->integer('id_user');
            $table->foreign('id_user')->references('id_user')->on('user');
            $table->primary(['id_lobby', 'id_user']);
            $table->integer('classement')->default(0);
            $table->integer('score')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jouer');
    }
}
