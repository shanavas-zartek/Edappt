<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myfolderstructure extends Model
{
    protected $table = 'my_folder_structure';

    protected $fillable = [
        'student_id',
        'my_folder_name',
        'parent_id',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
}
