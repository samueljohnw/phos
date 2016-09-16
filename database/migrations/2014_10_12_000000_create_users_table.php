<?php

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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('active')->default(true);
            $table->json('settings');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
          [
            'first_name'=>'Samuel',
            'last_name'=>'Werner',
            'email' =>'samueljwerner@gmail.com',
            'password'=> bcrypt('test'),
            'settings'=>[]

          ]
        ]);
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
