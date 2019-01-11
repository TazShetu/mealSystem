<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amountu extends Model
{
    protected $fillable = ['user_id', 'mealsystem_id', 'amount', 'expA'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
