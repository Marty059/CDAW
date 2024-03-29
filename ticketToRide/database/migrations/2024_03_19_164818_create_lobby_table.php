<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLobbyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lobby', function (Blueprint $table) {
            $table->integer('id_lobby')->autoIncrement();
            $table->string('name')->default(255);
            $table->integer('max_players')->default(5);
            $table->boolean('is_private')->default(false);
            $table->string('password')->default(null)->nullable();
            $table->boolean('has_started')->default(false);
            $table->boolean('has_ended')->default(false); 
            $table->dateTime('creation_date')->default(null);  
            $table->dateTime('start_date')->default(null)->nullable();   
            $table->double('duration')->default(0)->nullable();
            $table->integer('id_createur');
            $table->foreign('id_createur')->references('id_user')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lobby');
    }
}
