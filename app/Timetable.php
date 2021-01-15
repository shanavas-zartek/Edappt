<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $table = 'student_timetable';
    protected $fillable = [
        'student_id',
        'plan_date',
        'is_active',
        'created_at',
        'updated_at',
       'deleted_at'
    ];
}
