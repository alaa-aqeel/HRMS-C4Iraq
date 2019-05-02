<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\API\Config;

use Illuminate\Support\Facades\DB;
use App\UserPath;
use App\Paths;
use App\Tutorial;

use Validator;

class ControllerMangers extends Controller
{
    function __construct(){  Config::init(); }

    function team_governorate(){   

        $teams = DB::table('user_path')
            ->select('user_path.complatet',
                    'members.last_name','members.first_name','members.governorate',
                    'info_users.image_profile',
                    'contcats.id_telegram','contcats.id_facebook',
                    'paths.path')
            ->join('members','members.username','=','user_path.username')
            ->join('info_users','info_users.username','=','user_path.username')
            ->join('paths','paths.id','=','user_path.id_path')
            ->join('contcats','contcats.username','=','user_path.username')
            ->where(['members.governorate' => auth()->user()->governorate, 'members.team_manger' => 0])
            ->get();

        return response()->json( [ "Success" => [ "teams"=> $teams ] ]  );
    }

    function team_path(Paths $paths){

        if($paths->find(auth()->user()->id_path_manger))
        {
            $teams = DB::table('user_path')
            ->select(
                    'user_path.complatet',
                    'members.last_name','members.first_name','members.governorate',
                    'info_users.image_profile','contcats.id_telegram'
                )
            ->join('members','members.username','=','user_path.username')
            ->join('info_users','info_users.username','=','user_path.username')
            ->join('contcats','contcats.username','=','user_path.username')      
            ->where(['user_path.id_path' => auth()->user()->id_path_manger , 'members.id_path_manger' => 0])
            ->get();

            $path = Paths::select('path')
                    ->where(['id' => auth()->user()->id_path_manger ])
                    ->get();

            $tutorial = Tutorial::select("name",'url','tacher_name','count_video')
                    ->where(['path_id' => auth()->user()->id_path_manger ])
                    ->get();


            $tasks = DB::table('user_path')
                ->select('tasks.github_url','members.last_name','members.first_name','members.governorate')
                ->join('members','members.username','=','user_path.username')
                ->join('tasks','tasks.member_username','=','user_path.username')
                ->where(['user_path.id_path' => auth()->user()->id_path_manger , 'members.id_path_manger' => 0])
                ->get();

            return response()->json([ "Success" => [ 
                    "teams"=> $teams,
                    "path"=> $path,
                    "tutorials"=> $tutorial ,
                    'tasks' => $tasks
                ]]);
        }
        return response()->json([ "Errors" => 'not_path']);
    }


    public function manger_path_add_tutorial(Request $req,Tutorial $tutorial){
        $validator =   Validator::make($req->all(), [
            "path_id"     => "required" ,
            "name"        => "required" ,
            "url"         => "required" ,
            "tacher_name" => "required" ,
            "count_video" => "required" ,
        ]);
        
        if($validator->fails()){
            return response()->json(['Errors' => $validator->errors()]);
        }

        $tutorial = new Tutorial();

        $tutorial->paht_id      = $req->path_id;
        $tutorial->name         = $req->name;
        $tutorial->url          = $req->url;
        $tutorial->tacher_name  = $req->tacher_name;
        $tutorial->count_video  = $req->count_video;

        $tutorial->save();

        return response()->json(["Success"=>'Add Tutorial']);
    }   
}
