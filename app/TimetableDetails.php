<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimetableDetails extends Model
{  
    protected $table = 'student_timetable_details';
    protected $fillable = [
        'timetable_id',
        'time_from',
        'time_to',
        'schedule',
        'is_active',
        'created_at',
        'updated_at',
       'deleted_at'
    ];
}
