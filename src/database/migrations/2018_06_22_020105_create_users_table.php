<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');        
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->date('birthday');
            $table->string('nickname')->nullable();
            $table->string('occupation')->nullable();
            $table->string('address')->nullable();
            $table->string('api_key')->nullable();            
            $table->integer('role_id')->unsigned();
            $table->enum('is_active', [1, 0]);
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
        Schema::drop('users');
    }
}
