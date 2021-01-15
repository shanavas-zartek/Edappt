<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentdetail extends Model
{
    protected $table = 'parent_details';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_no',
        'mobile_verified_status',
        'mobile_verified_on',
        'alternate_no',
        'address',
        'district',
        'city',
        'state','country','pincode',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
