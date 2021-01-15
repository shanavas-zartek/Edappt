<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'city_name',
        
        'is_active',
       'updated_by',
        'created_at',
        'updated_at',
       
    ];
}
