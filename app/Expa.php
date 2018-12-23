<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expa extends Model
{
    protected $fillable = ['user_id', 'month', 'expA'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
