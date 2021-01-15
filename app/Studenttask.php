<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studenttask extends Model
{
    protected $table = 'student_tasks';
    protected $fillable = [
        'student_id',
        'task_id',
        'completed_status',
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
