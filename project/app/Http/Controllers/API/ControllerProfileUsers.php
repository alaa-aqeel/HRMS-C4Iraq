<?php

namespace App\Http\Controllers\API;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\UserPath;
use App\Contcat;
use App\InfoUser;

use App\Http\Controllers\API\Config;


class ControllerProfileUsers extends Controller
{
    function __construct(){  Config::init(); }

    function index(){

        $username = auth()->user()->username;
        $user = Member::find($username);
        
        if( !$user->info ){
            return response()->json(["Error" =>"user_not_have_profile"]);
        }
        
        return response()->json(["Success" =>[
                "user"=>$user->select(
                    "email",
                    "last_name",
                    "first_name",
                    "governorate"
                )->where('username',$username)->get(),
                "content"=>$user->content,
                "path"=> UserPath::find($username) ? UserPath::find($username)->path : UserPath::find($username),
                "info"=>$user->info
             ]
        ]);
        
    }

    function store(Request $request){

        $validator =   Validator::make($request->all(), [
            "gender"         => "required" ,
            "bron"           => "required|regex:/^[0-9]{4}+\-[0-9]{1,2}+\-[0-9]{1,2}$/"  ,
            "about"          => "required"  ,
            // "skills"         => "required" , 
            "image_profile"  => "required" ,
            "educational_attainment" => "required" ,
            'id_facebook'   => "required" ,
            'id_telegram'   => "required" ,
        ]);
        
        if($validator->fails()){
            return response()->json(['Errors' => $validator->errors()]);
        }
        
        if ( InfoUser::find(auth()->user()->username) ){
            return response()->json(['Errors' => "user_have_profile"]) ;
        }

        if ($request->hasFile('image_profile')){

            $image = $request->file('image_profile');
            $name = auth()->user()->username.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile');
            $image->move($destinationPath, $name);

        }else{ return response()->json(['image_profile' => "must_image_file"]); }

        $infouser = New InfoUser();
        
        $infouser->username               = auth()->user()->username;
        $infouser->gender                 = $request->gender;
        $infouser->bron                   = $request->bron;
        $infouser->about                  = $request->about;
        $infouser->skills                 = $request->skills ? $request->skills : "";
        $infouser->image_profile          = auth()->user()->username.'.'.$image->getClientOriginalExtension();
        $infouser->educational_attainment = $request->educational_attainment;

        $infouser->save();

        // 
        $contentUser  =  New Contcat();
        
        $contentUser->username      = auth()->user()->username;
        $contentUser->id_facebook   = $request->id_facebook;
        $contentUser->id_github     = $request->id_github ? $request->id_github : "" ;
        $contentUser->id_telegram   = $request->id_telegram;
        $contentUser->telephone     = ( $request->telephone ) ? $request->telephone : "" ;
        $contentUser->other_email   = ( $request->other_email )? $request->other_email : "";
        
        $contentUser->save();
        
        //
        return response()->json(["Success" => 'Successfully Create Profile']);
    }

    public function upload_image(Request $request){

        return response()->json(["Success" => $request->all() ]);
    }

    public function update(Request $request){
        
        if (!InfoUser::find(auth()->user()->username) ){
            return response()->json(['Errors' => "user_have_profile"]) ;
        }

        $user = Member::find(auth()->user()->username);

        $user->info->update($request->all());
        $user->content->update($request->all());

        $user->save();

        return response()->json(["Success" => " Successfully Update Profile "]);
    }
}
