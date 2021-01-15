<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionpollAnswers extends Model
{
    protected $table = 'option_poll_answers';
    protected $fillable = [
        'question_id',
        'answer',
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
