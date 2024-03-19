<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partie', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
            //$table->integer('tokenable_id')->autoIncrement();
            //$table->integer('id_createur');
            //$table->foreign('id_createur')->references('id_user')->on('user');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partie');
    }
}
