<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paths extends Model
{
    protected $table = 'paths';
    
    protected $fillable = [
        'id'   ,
        'path' ,
        'manger_path'
    ];
    
    public $timestamps = true;
    protected $primaryKey   = 'id';
    
    function users_path(){
        return $this->hasMany('App\UsersPath',"id_path","id","path");  
    }

    function team_manger(){
        return $this->hasManyThrough(
            'App\Users','App\UsersPath','id_path',"username","id","username"
        );
    }
}
