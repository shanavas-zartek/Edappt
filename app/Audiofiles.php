<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audiofiles extends Model
{
    protected $table = 'audio_files';

    protected $fillable = [
        'audio_file_name',
        'audio_length',
        'audio_title',
        'audio_description',
        'poster_image_file',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
    
    
}
