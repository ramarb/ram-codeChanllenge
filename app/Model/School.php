<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class School extends Model
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

    public static function getPasserCount(){
        return self::select(\DB::raw("schools.*, (select count(passers.id) from passers where passers.school_id = schools.id) as ctr"))
            ->orderBy('ctr','desc')
            ->get();
    }
}
