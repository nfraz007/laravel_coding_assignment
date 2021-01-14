<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthAPI extends Controller
{
    // public function __construct(){
    //     DB::beginTransaction();
    // }

    // public function index() {
    // 	echo "API is working fine";
    // }

    // public function login(Request $request){
    //     try{
    //     	// validating every thing
    //         $validator=Validator::make($request->all(), [
    //             "email"   => Rule::get("email"),
    //             "password" => Rule::get("password")
    //         ]);
    //         if($validator->fails()){
    //             throw new Exception($validator->errors()->first());
    //         }

    //         $email = trim($request->input("email"));
    //         $password = trim($request->input("password"));

    //         // check this email exist or not
    //         $user = UserService::get_by_email($email);
    //         if(!$user) throw new Exception("Sorry, This email does not exist.");
    //         if(!Hash::check($password, $user->password)) throw new Exception("You have entered incorrect password.");
    //         if($user->status != Status::active) throw new Exception("Sorry, But your account is INACTIVE.");
            
    //         $user_id = $user->id;

    //         // check for expired token and delete all of them
    //         UserTokenService::delete_expired_token_for_user($user_id);

    //         // // generate the token
    //         $token = Common::jwt_encode($user_id);

    //         // // put in session from start
    //         session()->flush();

    //         session()->put("token", "$token");
    //         session()->put("user_id", "$user_id");
    //         session()->put("default_app_id", "$user->default_app_id");
    //         // session()->put("user", new UserResource($user));

    //         // insert this token in the db
    //         UserTokenService::add_user_token($user_id, $token, [
    //             "ip" => $request->ip()
    //         ]);

    //         // update user table last_login_at
    //         UserService::update_user_last_login($user_id);

    //         $output_data = [
    //             "token" => $token,
    //             "redirect" => route("home")
    //         ];

    //         DB::commit();
    //         return Output::success("success_login", $output_data);
    //     }catch(Exception $e){
    //         DB::rollback();
    //         return Output::error($e->getMessage());
    //     }
    // }

    // // public function register(Request $request){
    // //     try{
    // //         // validating every thing
    // //         $validator=Validator::make($request->all(), [
    // //             "first_name" => $this->rule("name"),
    // //             "last_name" => $this->rule("name"),
    // //             "email"   => $this->rule("email"),
    // //             "password" => $this->rule("password"),
    // //             "password_confirm" => "same:password"
    // //         ]);
    // //         if($validator->fails()){
    // //             throw new Exception($validator->errors()->first());
    // //         }

    // //         $first_name = trim($request->input("first_name"));
    // //         $last_name = trim($request->input("last_name"));
    // //         $email = trim($request->input("email"));
    // //         $password = trim($request->input("password"));

    // //         // check this email exist or not
    // //         $user = UserModel::where("email", $email)->first();
    // //         if(count($user)) throw new Exception("This email is already regisered.");
            
    // //         $user_data = [
    // //             "slack" => $this->generate_slack("user"),
    // //             "first_name" => $first_name,
    // //             "last_name" => $last_name,
    // //             "email" => $email,
    // //             "password" => bcrypt($password),
    // //             "status" => "ACTIVE",
    // //             "created_at" => date(config("constant.datetime"))
    // //         ];
    // //         $user_id = UserModel::insertGetId($user_data);

    // //         $output_data = [
    // //             "redirect" => route("login")
    // //         ];

    // //         DB::commit();
    // //         return Output::success("success_register", $output_data);
    // //     }catch(Exception $e){
    // //         DB::rollback();
    // //         return Output::error($e->getMessage());
    // //     }
    // // }
}
