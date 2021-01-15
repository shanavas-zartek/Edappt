<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherOnDemand extends Model
{
    protected $table = 'teacher_on_demand';
    protected $fillable = [
        'student_id',
        'teacher_id',
        'requested_date',
        'requested_time',
        'question',
        'subject',
        'class',
        'approval_status',
        'approved_on',
        'approved_by',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
