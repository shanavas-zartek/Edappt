<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studygroupdtl extends Model
{
    protected $table = 'study_group_dtl';

    protected $fillable = [
      
        'study_group_hdr_id',
        'student_id',
       
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];
}
