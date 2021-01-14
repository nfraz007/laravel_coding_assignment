<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/", "APIController@index");

Route::group(["prefix" => "todo"], function(){
    Route::post("/", "api\TodoController@list");
    Route::post("/detail", "api\TodoController@detail");
    Route::post("/create", "api\TodoController@create");
    Route::post("/update", "api\TodoController@update");
    Route::post("/delete", "api\TodoController@delete");
});