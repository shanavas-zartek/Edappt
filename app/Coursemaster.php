<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursemaster extends Model
{
    protected $table = 'course_master';

    protected $fillable = [
        'course_name',
        'description',
        'ld_category_id',
        'age_group_id',
        'poster_image',
        'course_price',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
