<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planneritem extends Model
{
    protected $table = 'planner_item';

    protected $fillable = [
        'student_id',
        'planner_item_name',
        'planned_date',
        'status',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
