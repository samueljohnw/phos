<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChainLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chain_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chain_id')->unsigned()->index();;
            $table->foreign('chain_id')->references('id')->on('chains')->onDelete('cascade');
            $table->integer('contact_id')->unsigned()->index();;
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->integer('email_id')->unsigned()->index();;
            $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');                        
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
        Schema::drop('chain_logs');
    }
}
