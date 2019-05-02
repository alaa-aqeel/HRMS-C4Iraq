<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'id',
        'member_username',
        'github_url',
        'path_id'  
    ];


    protected $primaryKey = 'path_id';
}
