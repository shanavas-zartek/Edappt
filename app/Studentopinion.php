<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentopinion extends Model
{
    protected $table = 'student_opinions';
    protected $fillable = [
        'student_id',
        'opinion_poll_question_id',
        'opinion_poll_answer_id',
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
