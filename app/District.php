<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = [
        'district_name',
        
        'is_active',
       'updated_by',
        'created_at',
        'updated_at',
       
    ];
}
