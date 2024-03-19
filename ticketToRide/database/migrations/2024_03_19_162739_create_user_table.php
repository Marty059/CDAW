<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user')->autoIncrement()->unique();
            $table->string('username')->default(null);
            $table->string('password')->default(null);
            $table->string('email')->default(null);
            $table->string('country')->default(null);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_banned')->default(false); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
