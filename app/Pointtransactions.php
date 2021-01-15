<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pointtransactions extends Model
{
    protected $table = 'point_transactions';

    protected $fillable = [
        'parent_id',
        'student_id',
        'transaction_points',
        'transaction_description',
        'payment_id',
        'course_id',
        'teacher_on_demand_id',
        'book_id',
        'is_cancelled',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
