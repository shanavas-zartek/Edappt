<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentqueries extends Model
{
    protected $table = 'student_queries';

    protected $fillable = [
        'vendor_category_id',
        'vendor_id',
        'student_id',
        'question',
        'approved_status',
        'approved_by',
        'approved_on',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
