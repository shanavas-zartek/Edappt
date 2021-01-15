<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Optionpolltype extends Model
{
    protected $table = 'option_poll_types';
    protected $fillable = [
        'type',
        'description',
        
        'is_active',
        'is_deleted',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}
