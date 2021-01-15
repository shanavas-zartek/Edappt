<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminBlogs extends Model
{
    protected $table = 'admin_blogs';

    protected $fillable = [
        'blog_title',
        'description',
        'image1',
        'image2',
        'published_from',
        'published_to',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
