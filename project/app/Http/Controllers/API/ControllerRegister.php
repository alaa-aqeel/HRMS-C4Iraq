<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use Validator;
use JWTFactory;
use JWTAuth;
use App\Http\Controllers\API\Config;

class ControllerRegister extends Controller
{
    function __construct(){  Config::init(); }
   
    function index(Request $request){

        $validator =    Validator::make($request->all(), [
            'username'     => 'required|',
            'email'        => 'required|email|string',
            'governorate'  => "required",
            'first_name'   => 'required|string',
            'last_name'    => 'required|string',
            'password'     => 'required|min:8|regex:/^[a-zA-Z!@#$%^&*()]+$/', 
        ] );

        if($validator->fails()){
            return response()->json(['Errors' => $validator->errors()]);  
        }


        if ( Member::find($request->email) ){
            return response()->json(['Errors'  => 'This account is exist']);  
        }

        $member = new Member();
        $member->username      = $request->username;
        $member->email         = $request->email;
        $member->governorate   = $request->governorate;
        $member->first_name    = $request->first_name;        
        $member->last_name     = $request->last_name;
        $member->password      = bcrypt($request->password);

        $member->save();
        
        $token = JWTAuth::fromUser($member);
               
        return response()->json(['Success'=> ['user'=>$member,'token'=>$token]]);
    }
}
