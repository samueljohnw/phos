<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('zip')->after('last_name');
          $table->string('state')->after('last_name');
          $table->string('city')->after('last_name');
          $table->string('address')->after('last_name');
          $table->string('phone')->after('last_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn(['phone', 'address', 'city', 'state','zip']);
        });
    }
}
