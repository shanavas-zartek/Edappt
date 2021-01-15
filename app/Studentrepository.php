<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentrepository extends Model
{
    protected $table = 'student_repository_hdr';

    protected $fillable = [
        'student_id',
       
        'foldername',
        
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
