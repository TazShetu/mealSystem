<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mealsystem extends Model
{
    protected $fillable = ['month', 'meal_rate'];

    public function users(){
        return $this->belongsToMany('App\User');
    }

}
