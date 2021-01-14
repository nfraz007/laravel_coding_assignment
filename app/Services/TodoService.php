<?php

namespace App\Services;

use App\Models\Todo;
use App\Utils\Common;
use App\Models\Enums\TodoStatus;
use Carbon\Carbon;

interface TodoInterface
{
    public static function get($params);
	public static function get_by_id($id);
    public static function create_tree($todos);

    public static function add($title, $due_date, $params);

	public static function update($id, $params = []);

	public static function delete_by_id($id);
	public static function delete_old_date();
}

class TodoService implements TodoInterface
{
    public static function get($params = []){
        $db = Todo::not_deleted();

        // filter
        if(array_key_exists("filter_status_pending", $params) && $params["filter_status_pending"]){
            $db->where("status", TodoStatus::pending);
        }

        if(array_key_exists("filter_status_completed", $params) && $params["filter_status_completed"]){
            $db->where("status", TodoStatus::completed);
        }

        if(array_key_exists("filter_due_date", $params) && $params["filter_due_date"]){
            switch($params["filter_due_date"]){
                case "today": $db->where("due_date", date("Y-m-d 00:00:00")); break;
                case "this_week": $db->whereBetween("due_date", [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]); break;
                case "next_week": $db->whereBetween("due_date", [Carbon::now()->addDays(7)->startOfWeek(), Carbon::now()->addDays(7)->endOfWeek()]); break;
                case "overdue": $db->where("due_date", "<", Common::now()); break;
            }
        }

        if(array_key_exists("filter_search", $params) && $params["filter_search"]){
            $db->where("title", "like", "%".$params["filter_search"]."%");
        }

        // order
        $order_by = (array_key_exists("order_by", $params) && $params["order_by"]) ? $params["order_by"] : "due_date";
        $order_type = (array_key_exists("order_type", $params) && $params["order_type"]) ? $params["order_type"] : "asc";

        $db->orderBy($order_by, $order_type);
        return $db->get();
    }

	public static function get_by_id($id){
		return Todo::where("id", $id)->first();
    }
    
    public static function create_tree($todos){
        $data = [];
        foreach($todos as $todo){
            // $data
        }
    }

    public static function add($title, $due_date, $params = []){
        $parent_id = array_key_exists("parent_id", $params) && $params["parent_id"] ? $params["parent_id"] : 0;
        $status = array_key_exists("status", $params) && $params["status"] ? $params["status"] : TodoStatus::pending;

    	$data = [
            "parent_id" => $parent_id,
            "title" => $title,
            "status" => $status,
            "due_date" => $due_date,
            "created_at" => Common::now()
        ];
        $todo_id = Todo::insertGetId($data);
        return $todo_id;
    }
    
	public static function update($id, $params = []){
        Todo::where("id", $id)->update($params);
	}

	public static function delete_by_id($id){
        Todo::where("id", $id)->update([
            "status" => TodoStatus::deleted,
            "deleted_at" => Common::now()
        ]);
    }

    public static function delete_old_date(){
        Todo::where("deleted_at", "<", Carbon::now()->subMonth(1))->delete();
    }
}