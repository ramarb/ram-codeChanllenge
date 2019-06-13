<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Passer extends Model
{
    //

    protected $appends = ['school','division'];

    public static function page(){

    }

    public function division(){
        return $this->belongsTo('\App\Model\Division')->first();
    }

    public function school(){
        return $this->belongsTo('\App\Model\School')->first();
    }

    public function getSchoolAttribute(){
        return $this->school();
    }

    public function getDivisionAttribute(){
        return $this->division();
    }
}
