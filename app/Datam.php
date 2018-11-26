<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datam extends Model
{
    protected $fillable = ['user_id', 'mealsystem_id', 'day', 'meal', 'bazar'];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function mealsystems(){
        return $this->belongsToMany('App\Mealsystem');
    }

}
