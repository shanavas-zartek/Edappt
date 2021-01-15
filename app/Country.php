<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'country_name',
        
        'is_active',
       'updated_by',
        'created_at',
        'updated_at',
       
    ];
}
