<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memdata extends Model
{
    protected $fillable = ['user_id', 'mealsystem_id','month', 'day', 'meal', 'bazar'];



}
