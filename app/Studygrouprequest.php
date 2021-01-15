<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studygrouprequest extends Model
{
    protected $table = 'study_group_request';

    protected $fillable = [
      
        'student_id',
        'group_name',
        'message',
        'start_date',
        'approval_status',
        'approved_at',
        'approved_by',
        
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];
}
