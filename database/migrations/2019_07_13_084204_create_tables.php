<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('Topics',function (Blueprint $table){
            $table->increments('id');
            $table->string('topicname',100)->uniqoue();
            $table->timestamps();
    });
        Schema::create('Blocks', function(Blueprint $table){
            $table->increments('id');
            $table->integer('topicid')->unsigned();
            $table->foreign('topicid')->references('id')->on('Topics')->onDelete('cascade');
            $table->string('title',100);
            $table->longText('content',100)->nullable();
            $table->string('imagePath',255)->nullable();
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
        Schema::drop('Topics');
        Schema::drop('Blocks');
    }
}
