<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contcat extends Model
{
    protected $table = 'contcats';
    
    protected $fillable = [
        'username'   ,
        'id_facebook',
        'id_github'  ,
        'id_telegram',
        'telephone'  ,
        'other_email',
        "created_at" ,
        "updated_at"
    ];
    
    
    protected $keyType    = 'string';
    
    protected $primaryKey = 'username';
    
    public $incrementing  = false;
    
    protected $hidden     = [ 'username', "created_at", "updated_at"];
}
