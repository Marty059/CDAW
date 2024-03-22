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
            $table->integer('id_user')->autoIncrement()->unique();
            $table->string('username',20)->default(null);
            $table->string('password',30)->default(null);
            $table->string('email',100)->default(null);
            $table->string('country',50)->default(null);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_banned')->default(false); 
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
        Schema::dropIfExists('user');
    }
}
