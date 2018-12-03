<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datam extends Model
{
    protected $fillable = ['user_id', 'mealsystem_id','month', 'day', 'meal', 'bazar'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function mealsystems(){
        return $this->belongsToMany('App\Mealsystem');
    }




}
