<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursedetails extends Model
{
    protected $table = 'course_details';

    protected $fillable = [
        'course_master_id',
        'course_detail_title',
        'detail_description',
        'video_content_file',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
