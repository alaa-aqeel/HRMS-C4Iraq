<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\Config;
use App\Member;
use Validator;
use JWTAuth;

class ControllerMember extends Controller
{
    function __construct(){  Config::init(); }

    /*
     * @api {GET} /member/
     *
     */
    public function index(){ return response()->json([ 'user' => auth()->user() ] );  }


    /*
     * @api {POST} /member/mpass   
     *  
     * @body* { new_password, curent_password  } 
     * 
     */
    public function edit_password(Request $request,Member $member)
    {
        $validator =   Validator::make($request->all(), [
            'cureent_password' => "required|min:8|regex:/^[a-zA-Z!@#$%^&*()]+$/"  ,
            "new_password"     => "required|min:8|regex:/^[a-zA-Z!@#$%^&*()]+$/"  ,
        ]);

        if($validator->fails()){
            return response()->json(['Errors' => $validator->errors()]);
        }
        
        $member = $member->find(auth()->user()->username);

        if(JWTAuth::attempt(["email"=>auth()->user()->email, "password" => $request->cureent_password] ) )
        {
            $member->password = bcrypt($request->new_password);
            $member->save();
        }else{ return response()->json(["Errors" => "current_password_notcurrect"]); }
               
        return response()->json(["Success" => "success_update_password"]);
    }
}
