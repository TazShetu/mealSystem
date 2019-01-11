<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealandbazargraphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mealandbazargraphs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mealsystem_id');
            $table->integer('day');
            $table->integer('month');
            $table->integer('totalMeal')->default(0);
            $table->integer('totalBazar')->default(0);
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
        Schema::dropIfExists('mealandbazargraphs');
    }
}
