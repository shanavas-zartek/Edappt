<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audiolistenhistory extends Model
{
    protected $table = 'audio_listen_history';

    protected $fillable = [
        'audio_file_id',
        'student_id',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
    
    
}
