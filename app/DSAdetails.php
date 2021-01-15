<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DSAdetails extends Model
{
    protected $table = 'dsa_details';

    protected $fillable = [
        'vendor_id',
       
        'first_name',
        'last_name',
       
        'address',
        'city','district','state','country','pincode',
        'email',
        'contact_no',
       'alternate_no',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
