<?php

namespace App\Models\Enums;

class Enum
{
    public static function get_wrapper($data = [], $key = ""){
        if(array_key_exists($key, $data)){
            return $data[$key];
        }
        return $data;
    }
}