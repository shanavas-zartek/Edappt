<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table = 'states';
    protected $fillable = [
        'state_name',
        
        'is_active',
       'updated_by',
        'created_at',
        'updated_at',
       
    ];
}
