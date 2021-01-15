<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentpreferences extends Model
{
    protected $table = 'student_preferences';

    protected $fillable = [
        'preference_category_id',
        'student_id',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
