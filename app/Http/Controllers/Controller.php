<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){

    }

    // public function data(){
    //     $token = session()->get("token");

    //     $user_id = session()->get("user_id");
    //     $user = new UserResource(UserService::get_by_self());
    //     $modules = UserPermissionService::get_group_module_by_user_id($user_id);
    //     $default_app_id = session()->get("default_app_id");
    //     $app = new AppResource(AppService::get_by_id($default_app_id));
    //     $select_app = UserPermissionService::get_app_by_user_id($user_id);

    //     $data = [
    //         "token" => $token,
    //         "current_user_id" => $user_id,
    //         "current_user" => $user,
    //         "current_user_default_app_id" => $default_app_id,
    //         "current_app" => $app,
    //         "current_modules" => $modules,
    //         "current_select_app" => $select_app,
    //     ];
    //     // echo json_encode($data);die;
    //     return $data;
    // }

    // public function email_config(){
    //     $data = $this->data();
    //     $setting = $data["user_company_setting"];

    //     Config::set("mail", [
    //         "driver" => $setting["mail_driver"],
    //         "host" => $setting["mail_hostname"],
    //         "username" => $setting["mail_username"],
    //         "password" => $setting["mail_password"],
    //         "from" => ["address" => $setting["mail_from_email"], "name" => $setting["mail_from_name"]],
    //         "port" => $setting["mail_port"],
    //         "encryption" => $setting["mail_encryption"],
    //     ]);
    // }

    // public function send_email($to, $subject, $template, $data = []){
    //     $data = array_merge($data, $this->data());
    //     $this->email_config();

    //     // add production protection
    //     if(!app()->environment("production")) $to = "nfraz007@gmail.com";

    //     try{
    //         Mail::send($template, $data, function($email) use ($data, $to, $subject){
    //             $email->to($to)->subject($subject);

    //             if(array_key_exists("attachment", $data)){
    //                 $attachment = $data["attachment"];
    //                 $email->attachData($attachment["file"], $attachment["filename"]);
    //             }
    //         });
    //     }catch(Exception $e){
    //         return $e->getMessage();
    //     }
    //     return false;
    // }

    // public function prepare($db, $request, $search_array = []) {
    //     $status = trim($request->input("status"));
    //     $offset = trim($request->input("offset"));
    //     $limit = trim($request->input("limit"));
    //     $order_by = trim($request->input("order_by"));
    //     $order_type = trim($request->input("order_type"));

    //     // code for filter
    //     $from_created_at = trim($request->input("from_created_at"));
    //     if($from_created_at){
    //         $db->where("created_at", ">=", date("Y-m-d 00:00:00", strtotime($from_created_at)));
    //     }

    //     $to_created_at = trim($request->input("to_created_at"));
    //     if($to_created_at){
    //         $db->where("created_at", "<=", date("Y-m-d 23:59:59", strtotime($to_created_at)));
    //     }

    //     $search = trim($request->input("search"));
    //     if($search){
    //         $db->where(function($query) use ($search, $search_array){
    //             foreach($search_array as $column) {
    //                 $query->orWhere($column, "like", "%$search%");
    //             }
    //             return $query;
    //         });
    //     }

    //     $status = trim($request->input("status"));
    //     if($status){
    //         $db->where("status", $status);
    //     }

    //     // total fltered count
    //     $items_total = $db->count();

    //     // add filter
    //     if($limit) $db->limit($limit);
    //     if($offset) $db->offset($offset);
    //     if($order_by) $db->orderBy($order_by, $order_type); 

    //     $items = $db->get();

    //     return [
    //         "items" => $items,
    //         "items_total" => $items_total
    //     ];
    // }
}
