<?php

namespace App\Utils;

class Output
{
    public static function success($message = "", $data = []){
    	return static::output(200, $message, $data);
    }

    public static function error($message = ""){
        return static::output(400, $message);
    }

    public static function unauthorise($message = ""){
        return static::output(401, $message);
    }

    public static function not_found($message = ""){
        return static::output(404, $message);
    }

    public static function permission_denied($message = ""){
        return static::output(405, $message);
    }

    public static function output($status = 200, $message = "", $data = []){
    	return response()->json([
    		"status" => $status,
    		"message" => $message,
    		"data" => $data
    	]);
    }
}