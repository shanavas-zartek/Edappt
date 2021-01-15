<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussionforumdtl extends Model
{
    protected $table = 'discussion_forum_dtl';

    protected $fillable = [
        'discussion_hdr_id',
        'student_id',
        'likes',
        'reply',
      
        'approved_status',
        'approved_on',
        'approved_by',
       
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
