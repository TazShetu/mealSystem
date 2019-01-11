<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mealandbazargraph extends Model
{
    protected $fillable = ['mealsystem_id', 'day', 'totalMeal', 'totalBazar'];
}
