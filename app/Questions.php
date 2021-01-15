<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'content_category_questions';
    protected $fillable = [
        'content_category_hdr_id', 
        'question',
        'description',
        'question_type',
        'file',
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
