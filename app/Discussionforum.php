<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussionforum extends Model
{
    protected $table = 'discussion_forum_hdr';
    protected $fillable = [
        'discussion_category_id',
        'topic',
        'description',
        'image',
        'start_date',
        'end_date',
        'is_active',
        'is_deleted',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}
