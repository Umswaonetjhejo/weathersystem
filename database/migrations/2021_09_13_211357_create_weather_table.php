<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->string('coord');
            $table->string('weather');
            $table->string('base');
            $table->string('main');
            $table->integer('visibility');
            $table->string('wind');
            $table->string('clouds');
            $table->integer('dt');
            $table->string('sys');
            $table->integer('timezone');
            $table->string('name');
            $table->integer('cod');
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
        Schema::dropIfExists('weather');
    }
}
