<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendors extends Model
{
    protected $table = 'vendor_details';

    protected $fillable = [
        'vendor_category_id',
        'age_group_id',
        'DSA_id',
        'first_name',
        'last_name',
        'subject',
        'address',
        'city','district','state','country','pincode',
        'email',
        'phone',
        'gender',
        'dob',
        'qualification',
        'experience',
        'description',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
