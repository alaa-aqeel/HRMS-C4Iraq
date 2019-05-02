<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Config extends Controller
{
    static public function init(){

        \Config::set('jwt.user',"App\Member");
        \Config::set("auth.providers.users.model",\App\Member::class);
        \Config::set("auth.providers.users.table","members");
        
    }
}
