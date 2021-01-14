<?php

namespace App\Utils;

use App\Models\Enums\TodoStatus;

interface RuleInterface{
    public static function get($type, $required = true);
    public static function status($type = "status");
}

class Rule implements RuleInterface{
    public static function get($type, $required = true){
        $data = "";

        switch($type){
            case "id"                 : $data = "nullable|numeric|min:1|max:9999999999"; break;
            case "title"              : $data = "nullable|string|max:200"; break;
            case "date"               : $data = "nullable|regex:/^[123][0-9]{3}-[01][0-9]-[0123][0-9]$/|max:10"; break;
            case "todo_status"        : $data = Rule::status("todo_status"); break;
        }

        if($required) return implode("|", ["required", $data]);
        else return $data;
    }

    public static function status($type = "status"){
        switch($type){
            case "todo_status": $data = TodoStatus::get(); break;
        }

        $data = array_keys($data);
        return "in:".implode(",", $data);
    }
}