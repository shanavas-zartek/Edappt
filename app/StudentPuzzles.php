<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentPuzzles extends Model
{
    protected $table = 'student_content_category_results';

    protected $fillable = [
        'student_id',
        'content_category_hdr_id',
        'content_category_qus_id',
        'content_category_ans_id',
        'created_at'      
    ];
}
