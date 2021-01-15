<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    protected $table = 'student_achievements';

    protected $fillable = [
        'preference_category_id',
        'student_id',
        'title',
        'description',
        'image',
        'approval_status',
        'approved_on',
        'approved_by',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];
}
