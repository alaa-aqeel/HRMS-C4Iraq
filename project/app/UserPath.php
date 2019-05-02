<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPath extends Model
{
    protected $table = 'user_path';

    protected $fillable = [
        'id_path'   ,
        'username'  ,
        'complatet' ,
    ];
    
    public $timestamps  = false;
    
    protected $keyType  = 'string';
    
    protected $primaryKey = 'username';
    
    public $incrementing = false;
    
    
    // Get Path For User
    function path(){  
        return $this->hasMany('App\Paths',"id","id_path");  
    }
    
    function path_manger(){
        return $this->hasManyThrough('App\Member','App\UsersPath','id_path',"username","username","id");  
    }
    
}
