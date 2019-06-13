<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //
    public static function getSet($name){

        $name = trim($name);

        $res = self::where('name','=',$name)->first();

        $ret = $res;

        if(!$res){
            $obj = new self();
            $obj->name = $name;
            $obj->save();
            $ret = $obj;
        }

        return $ret;

    }

}
