<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    protected $table = 'user_projects';
    
    protected $fillable = [
        'id',
        'project_name',
        "start_at",
        "end_at",
        "about_project",
        "github_url",
        "tags",
        "created_at",
        "updated_at"
    ];
    
    protected $hidden     = ["created_at",'username'];
    
    protected $keyType    = 'string';

    protected $primaryKey = 'username';
    
    public $incrementing  = false;
    

}
