<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookslot extends Model
{
    protected $table = 'bookslot';
    protected $fillable = [
        'student_id', 
        'topic',
        'description',
        'file',
        'requested_date',
        'requested_time',
        'start_date',
        'start_time',
        'end_time',
        'approval_status',
        'approved_on',
        'approved_by',
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
