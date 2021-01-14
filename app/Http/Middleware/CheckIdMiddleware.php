<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Utils\Output;
use Illuminate\Support\Facades\DB;

class CheckIdMiddleware
{
    public function handle($request, Closure $next, $table = "")
    {   
        try{
            // get the id
            $id = $request->input("id");

            $db = DB::table($table)->where("id", $id);

            if(in_array($table, ["todos"])){
                $db = $db->where("status", "!=", "-1");
            }
            
            $data = $db->first();

            if(!$data) throw new Exception("Not Found.");

            return $next($request);
        }catch(Exception $e){
            return Output::not_found($e->getMessage());
        }
    }
}