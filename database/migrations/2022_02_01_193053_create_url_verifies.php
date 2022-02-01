<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlVerifies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_verifies', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->longText('response');
            $table->integer('http');
            $table->bigInteger('url_id')->unsigned();
            $table->timestamps();

            //foreign keys
            $table->foreign('url_id')->references('id')->on('urls');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_verifies');
    }
}
