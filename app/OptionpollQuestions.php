<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionpollQuestions extends Model
{
    protected $table = 'option_poll_questions';
    protected $fillable = [
        'question',
        'poll_type_id',
        'approval_status',
        'approved_on',
        'approved_by',
        'is_active',
        'is_deleted',
        'is_admin',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}
