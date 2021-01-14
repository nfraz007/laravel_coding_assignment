<?php

namespace App\Http\Controllers;

use App\Utils\Output;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function index(Request $request){
        return Output::success("API working fine.");
    }
}
