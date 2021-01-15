<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postings extends Model
{
    protected $table = 'student_postings';
    protected $fillable = [
        'topic',
        'description',
        'post_image',
        'post_video',
        'student_id',
        'category_id',
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
