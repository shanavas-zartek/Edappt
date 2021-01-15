<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursespurchased extends Model
{
    protected $table = 'courses_purchased';

    protected $fillable = [
        'course_master_id',
        'parent_id',
        'student_id',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
