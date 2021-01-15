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
		 'dob',
        'mobile_verified_status',
        'mobile_verified_on',
        'alternate_no',
        'address',
        'district',
        'city',
        'state','country','pincode',
		 'address_office',             
            'qualification',             
            'occupation' ,              
            'employment_type' ,         
            'annual_income' ,           
            'spouse_name',               
            'spouse_dob' ,              
            'spouse_employment_type' ,   
            'spouse_address_office' ,  
            'spouse_qualification'  ,   
            'spouse_occupation',         
            'spouse_annual_income' ,     
          'mac_address',
          'mac_address2',
          'mac_address3',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
