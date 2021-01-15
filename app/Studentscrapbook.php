<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentscrapbook extends Model
{
    protected $table = 'scrap_book';

    protected $fillable = [
        'student_id',
       
        'notes',
        
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
