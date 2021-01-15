<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussionforumcategory extends Model
{
    protected $table = 'discussion_forum_category';
    protected $fillable = [
        'category_name',
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
