<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentgoals extends Model
{
    protected $table = 'student_goals';

    protected $fillable = [
        'student_id',
       'start_date',
	   'start_time',
	   'end_date',
	   'end_time',
        'goal_name',
        'description',
        
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
