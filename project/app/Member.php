<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Member extends Model implements Authenticatable
{
    use AuthenticableTrait ;

    protected $table = 'members';

    protected $fillable = [
        'id'         ,
        'username'   ,
        'email'      ,
        'first_name' ,
        'last_name'  ,
        'password'   ,
        "governorate",
        "created_at" ,
        "updated_at"   
    ];
     
    protected $hidden  = [ 
        'id'         ,
        'password'   ,
        "created_at" ,
        "updated_at" ,
    ];
   
    protected $keyType      = 'string'; 
    protected $primaryKey   = 'username';
    public    $incrementing = false;
    
    
    // Get InfoUser For User 
    function info(){     return $this->hasOne('App\InfoUser',"username");      }

    // Get Contcatt  For User 
    function content(){  return $this->hasOne('App\Contcat',"username");       }

}
