<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company_settings';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state','country','district','pincode','contact_person',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by'
    ];
}
