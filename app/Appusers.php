<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appusers extends Model
{
    protected $table = 'app_users';
    protected $fillable = [
        'parent_id',
        'username', 
        'password',
        'is_active',
        'is_deleted',
        'created_at',
        'updated_at',
        'deleted_at',
      
    ];
}
