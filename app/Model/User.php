<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $appends = ['user_state'];

    public function user_state(){
        return $this->belongsTo('\App\Model\UserState');
    }

    public function getUserStateAttribute(){
        return $this->user_state()->first();
    }
}
