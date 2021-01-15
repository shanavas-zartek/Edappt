<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studygroup extends Model
{
    protected $table = 'study_group_hdr';

    protected $fillable = [
      
        'requested_student_id',
        'group_name',
        'chat_option',
        'zoom_call_option',
        'approval_status',
        'approved_on',
        'approved_by',
        'start_date',
        'end_date',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];
}
