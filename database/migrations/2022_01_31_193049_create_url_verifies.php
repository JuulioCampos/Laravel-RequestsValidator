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
            $table->integer('id')->unsigned()->primary();
            $table->string('url', 70)->nullable(false);
            $table->string('response', 10000)->nullable(false);
            $table->integer('http')->nullable(false);
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
        Schema::dropIfExists('url_verifies');
    }
}
