<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $table = 'content_category_answers';
    protected $fillable = [
        'question_id', 
        'answer_option',
        'is_correct_answer',
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
