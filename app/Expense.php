<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_is', 'a', 'month', 'day', 'exp'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
