<?php

namespace App\Utils;

interface CommonInterface{
    public static function now();
    public static function object_to_array($object);
}

class Common implements CommonInterface
{
    public static function now(){
        return date("Y-m-d H:i:s");
    }
    
    public static function object_to_array($object){
        $array = json_decode(json_encode($object), true);
        return $array;
    }
}