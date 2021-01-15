<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentDetails extends Model
{
    protected $table = 'content_category_hdr';
    protected $fillable = [
        'name',
        'description',
        'content_category_id',
        'subject_id',
        'image',
        'duration',
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
