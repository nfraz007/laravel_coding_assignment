<?php

namespace App\Models\Enums;

use App\Models\Enums\Enum;

class TodoStatus extends Enum
{
    public const pending = "0";
    public const completed = "1";
    public const deleted = "-1";

    public static function get($key = ""){
        $data = [
            static::pending => ["label" => "Pending", "color" => "success"],
            static::completed => ["label" => "Completed", "color" => "success"],
        ];
        return static::get_wrapper($data, $key);
    }
}