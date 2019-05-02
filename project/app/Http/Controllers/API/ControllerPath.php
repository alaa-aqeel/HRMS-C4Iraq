<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\UserPath;
use App\Paths;
use App\Tutorial;
use Validator;

class ControllerPath extends Controller
{
    function __construct(){  Config::init(); }

    function index(UserPath $user){

        if( !$user->find( auth()->user()->username ) ){
            return response()->json(["Errors" => "you_nothave_path" ]);
        }
        $path = DB::table('user_path')->select("paths.path",'user_path.complatet')
                ->join('paths','paths.id','=','user_path.id_path')
                ->where(['user_path.username' => auth()->user()->username, ])
                ->get();
        
        $tutorial = DB::table('user_path')->select("paths.path",'user_path.complatet')
                ->join('paths','paths.id','=','user_path.id_path')
                ->where(['user_path.username' => auth()->user()->username, ])
                ->get();

        $tutorial = Tutorial::select("name",'url','tacher_name','count_video')
                ->where(['path_id' => $user->find(auth()->user()->username)->id_path ])
                ->get();

        return response()->json([
            "Success" => [
                'path' => $path,
                'tutorial' => $tutorial
            ]
        ]);
    }

    function getPaths(Paths $paths){
        return response()->json(["Success" => $paths->select("id","path")->get() ]);
    }


    function store(Request $req){

        $validator =   Validator::make($req->all(), [
            "id"         => "required" ,
            "complatet"  => "required" ,
        ]);
        
        if($validator->fails()){
            return response()->json(['Errors' => $validator->errors()]);
        }
        $pathuser = UserPath::find(auth()->user()->username);

        if($pathuser){

            if($req->id){
                $pathuser->id_path = $req->id;
                $pathuser->complatet = 0;            
                $pathuser->save();
            }else{
                $pathuser->complatet = $req->complatet;             
                $pathuser->save();
            }

        }else{
            $pathuser = new  UserPath();
            $pathuser->username = auth()->user()->username;
            $pathuser->id_path  = $req->id;
            $pathuser->complatet = 0; 
            $pathuser->save();
        }
        
        return response()->json(["Success" => 'select_path']);
    }
}
