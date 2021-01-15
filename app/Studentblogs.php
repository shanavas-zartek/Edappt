<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentblogs extends Model
{
    protected $table = 'student_blogs';

    protected $fillable = [
        'student_id',
        'blog_title',
        'description',
        'file',
        'file_type',
        'approval_status',
        'approved_on',
        'approved_by',
        'published_from',
        'published_to',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
