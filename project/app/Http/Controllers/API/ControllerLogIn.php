<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use JWTFactory;
use JWTAuth;

use App\Http\Controllers\API\Config;

class ControllerLogIn extends Controller
{
    function __construct(){  Config::init(); }

    function index(Request $req){

        $validator =   Validator::make($req->all(), [
            'email'  => 'required|email|',
            'password'  => 'required|', 
        ] );

        if($validator->fails()){
            return response()->json(['Errors' => $validator->errors()], 401);  
        }
        
        try {
            if (!$token = JWTAuth::attempt(["email"=>$req->email, "password" => $req->password])) {
                return response()->json(['Errors' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['Errors' => 'could_not_create_token'], 500);
        }catch (Exception $e) {
            return response()->json(['Errors'], 500);
        }

        return response()->json(compact('token'));
    }
}
