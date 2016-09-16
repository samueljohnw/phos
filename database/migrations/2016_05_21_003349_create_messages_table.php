<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chain_id')->unsigned()->index();;
            $table->foreign('chain_id')->references('id')->on('chains')->onDelete('cascade');
            $table->string('subject');
            $table->text('body');
            $table->integer('days');
            $table->time('time');
            $table->dateTime('scheduled_at')->nullable()->default(null);            
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
        Schema::drop('messages');
    }
}
