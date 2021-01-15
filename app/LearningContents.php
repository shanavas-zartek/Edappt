<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningContents extends Model
{
    protected $table = 'ld_contents';

    protected $fillable = [
        'category_id',
        'file',
        'file_type',
        'description',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
