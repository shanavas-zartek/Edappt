<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendorcategory extends Model
{
    protected $table = 'vendor_category';
    protected $fillable = [
        'category',
        'description',
        'icon',
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
