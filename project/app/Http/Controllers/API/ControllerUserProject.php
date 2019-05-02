<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\UserProject;
use Validator;
use App\Http\Controllers\API\Config;

class ControllerUserProject extends Controller
{
    function __construct(){  Config::init(); }

    public function index(UserProject $projects){

        $user = $projects->find(auth()->user()->username);

        if (!$user){
            return response()->json(["Errors" => "user_not_have_project"] );
        }

        return response()->json(["Success" => $user->paginate(10) ]);
    }

    public function store(Request $request){

        $validator =   Validator::make($request->all(), [
            "project_name"     => "required" ,
            "start_at"         => "required" ,
            "end_at"           => "required" ,
            "about_project"    => "required" ,
            "github_url"       => "required" ,
            "tags"             => "required" ,

        ]);
        
        if($validator->fails()){
            return response()->json(['Errors' => $validator->errors()]);
        }
        

        $porject = new UserProject();
        
        $porject->username      = auth()->user()->username;
        $porject->project_name  = $request->project_name;
        $porject->start_at      = $request->start_at;
        $porject->end_at        = $request->end_at;
        $porject->about_project = $request->about_project;
        $porject->github_url    = $request->github_url;
        $porject->tags          = $request->tags;

        
        $porject->save();
        
        return response()->json(["Success" => "success_add_project"]);
        
    }


    public function show(UserProject $projects,$id){
        $project = $projects::find(auth()->user()->username)->where('id',$id);

        if( $project->count() ){
            return response()->json([ "Success" =>$project->get() ]);
        }

        return response()->json(["Errors" => "not_found_project"]);
    }


    public function update(Request $request,UserProject $projects,$idProject){

        $project = $projects::find(auth()->user()->username)->where("id",$idProject);
        
        if(!$project->count() ){
            return response()->json(["Errors" =>"not_found_project"]);
        }
        
        $project->update($request->all());

        return response()->json(["Success" => "success_update_project"]);
    }

    public function destroy(UserProject $projects,$idProject){    
        $project = $projects::find(auth()->user()->username)->where("id",$idProject);
        
        if(!$project->count() ){
            return response()->json(["Errors" =>"not_found_project"]);
        }

        $project->delete();
        
        return response()->json(["Success" => "success_delete_project"]);
    }
    
}
