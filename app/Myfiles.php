<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myfiles extends Model
{
    protected $table = 'my_files';

    protected $fillable = [
        'student_id',
        'my_file_name',
        'display_name',
        'file_size',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
}
