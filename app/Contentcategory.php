<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contentcategory extends Model
{
    protected $table = 'content_category';
    protected $fillable = [
        'category',
        'description',
        'age_group_id',
        'day',
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
