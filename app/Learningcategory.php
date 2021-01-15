<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learningcategory extends Model
{
    protected $table = 'ld_category';

    protected $fillable = [
        'category',
        'description',
        'age_group_id',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
