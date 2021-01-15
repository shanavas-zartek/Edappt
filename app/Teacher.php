<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $fillable = [
        'age_group_id',
        'first_name',
        'last_name',
        'subject',
        'address',
        'district',
        'city',
        'state',
        'country',
        'pincode',
        'email',
        'phone',
        'gender',
        'dob',
        'qualification',
        'experience',
        'resume',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
