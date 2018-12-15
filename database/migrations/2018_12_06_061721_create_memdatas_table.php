<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memdatas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('mealsystem_id')->unsigned();
            $table->integer('month')->unsigned();
            $table->integer('day')->unsigned();
            $table->integer('meal')->nullable();
            $table->integer('bazar')->nullable();
            $table->integer('deposit')->nullable();
            $table->boolean('dbm')->nullable();
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
        Schema::dropIfExists('memdatas');
    }
}
