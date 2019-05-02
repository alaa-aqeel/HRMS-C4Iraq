<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $table = 'tutorials';

    protected $fillable = [
        'path_id'         ,
        'name'   ,
        'url'      ,
        'tacher_name' ,
        'count_video' 
    ];
    
    public $timestamps = false;
    protected $primaryKey = 'path_id';
}
