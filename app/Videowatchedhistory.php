<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videowatchedhistory extends Model
{
    protected $table = 'video_watched_history';

    protected $fillable = [
        'video_file_id',
        'student_id',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
    
    
}
