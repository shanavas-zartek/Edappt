<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mydiary extends Model
{
    protected $table = 'my_diary';

    protected $fillable = [
        'student_id',
        'my_day',
        'my_notes',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
}
