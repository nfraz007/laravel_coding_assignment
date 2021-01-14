<?php

namespace App\Http\Controllers\api;

use Exception;
use Validator;
use App\Utils\Rule;
use App\Utils\Common;
use App\Utils\Output;
use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Models\Enums\TodoStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function __construct(){
        $this->middleware("check_id:todos")->only(["detail", "update", "delete"]);

        DB::beginTransaction();
    }

    public function list(Request $request){
        try{
            $data = [];
            $filter_status_pending = trim($request->input("filter_status_pending"));
            $filter_status_completed = trim($request->input("filter_status_completed"));
            $filter_due_date = trim($request->input("filter_due_date"));
            $filter_search = trim($request->input("filter_search"));

            $params = [
                "filter_status_pending" => $filter_status_pending,
                "filter_status_completed" => $filter_status_completed,
                "filter_due_date" => $filter_due_date,
                "filter_search" => $filter_search,
            ];
            $todos = TodoResource::collection(TodoService::get($params));
            // $todos = TodoService::create_tree($todos);

            $data["todos"] = $todos;
            return Output::success("Success", $data);
        }catch(Exception $e){
            return Output::error($e->getMessage());
        }
    }

    public function detail(Request $request)
    {
        try {
            // validating every thing
            $validator = Validator::make($request->all(), [
                "id" => Rule::get("id"),
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $id = trim($request->input("id"));

            // get this todo
            $todo = TodoService::get_by_id($id);
            $todo = new TodoResource($todo);

            // output
            $data = [
                "todo" => $todo
            ];

            DB::commit();
            return Output::success("Successfully get the data.", $data);
        } catch (Exception $e) {
            DB::rollback();
            return Output::error($e->getMessage());
        }
    }

    public function create(Request $request){
        try{
            // validating every thing
            $validator=Validator::make($request->all(), [
                "title" => Rule::get("title"),
                "due_date" => Rule::get("date"),
                "parent_id" => Rule::get("id", false),
                "status" => Rule::get("status", false)
            ]);
            if($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $title = trim($request->input("title"));
            $due_date = trim($request->input("due_date"));
            $parent_id = trim($request->input("parent_id"));
            $status = trim($request->input("status"));

            // check this todo exist or not
            if($parent_id){
                $parent = TodoService::get_by_id($parent_id);
                if(!$parent) throw new Exception("Parent Todo does not exist.");
            }
            
            $todo_id = TodoService::add($title, $due_date, [
                "parent_id" => $parent_id,
                "status" => $status
            ]);
            
            $data = [
                "todo_id" => $todo_id
            ];

            DB::commit();
            return Output::success("Successfully created.", $data);
        }catch(Exception $e){
            DB::rollback();
            return Output::error($e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            // validating every thing
            $validator=Validator::make($request->all(), [
                "id" => Rule::get("id"),
                "title" => Rule::get("title"),
                "due_date" => Rule::get("date"),
                "parent_id" => Rule::get("id", false),
                "status" => Rule::get("todo_status")
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $id = trim($request->input("id"));

            $title = trim($request->input("title"));
            $due_date = trim($request->input("due_date"));
            $status = trim($request->input("status"));
            $parent_id = trim($request->input("parent_id"));

            // update project table
            TodoService::update($id, [
                "parent_id" => $parent_id ? $parent_id : 0,
                "title" => $title,
                "due_date" => $due_date,
                "status" => $status,
                "updated_at" => Common::now()
            ]);

            // output
            $data = [];

            DB::commit();
            return Output::success("Successfully updated.", $data);
        } catch (Exception $e) {
            DB::rollback();
            return Output::error($e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            // validating every thing
            $validator = Validator::make($request->all(), [
                "id" => Rule::get("id"),
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $id = trim($request->input("id"));

            // delete this todo
            TodoService::delete_by_id($id);

            // output
            $data = [];

            DB::commit();
            return Output::success("Successfully deleted.", $data);
        } catch (Exception $e) {
            DB::rollback();
            return Output::error($e->getMessage());
        }
    }
}
