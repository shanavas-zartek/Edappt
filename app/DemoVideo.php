<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemoVideo extends Model
{
    protected $table = 'demo_videos';
    protected $fillable = [
        'title',
        'file',
        'type',
        'size',
        'description',
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
