<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    protected $table = "info_users";
    
    protected $fillable = [
        "username",
        "gender",
        "bron",
        "about",
        "skills",
        "image_porfile",
        "educational_attainment",
        // "programming_languages",
        "created_at",
        "updated_at"
    ];
    
    public $incrementing = false;

    protected $keyType = 'string';
    
    protected $primaryKey = 'username';
    
    protected $hidden = ["username",];
}
