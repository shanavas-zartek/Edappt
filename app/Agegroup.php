<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agegroup extends Model
{
    protected $table = 'agegroup';

    protected $fillable = [
        'age_group',
        'description',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
}
