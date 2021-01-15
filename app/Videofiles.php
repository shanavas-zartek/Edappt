<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videofiles extends Model
{
    protected $table = 'video_files';

    protected $fillable = [
        'category_id',
        'age_group_id',
        'video_file_name',
        'video_length',
        'video_title',
        'video_description',
        'poster_image_file',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
}
