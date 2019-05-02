<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educatioin extends Model
{
    protected $table = 'educatioins';
    
    protected $fillable = [
        'username'   ,
    ];
    
    
    protected $keyType    = 'string';
    
    protected $primaryKey = 'username';
    
    public $incrementing  = false;
    
    protected $hidden     = [ 'username', "created_at", "updated_at"];
}
