<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [ 
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required|unique:vendor_details,phone|digits:10',
            'dob' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'age'  => ' required',
            'vendor'  => ' required',
            'gender'  => ' required',
            'pincode'  => ' required',
            'subject'  => ' required',
            'qualification'  => ' required',
            'status'  => ' required',
            'experience'=> ' required',
            'district' => 'required',
        ];


    }
    public function messages()
    {
      return [
       'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone number is required',
            'address.required' => 'Address is required',
            'city.required' => 'City is required',
            'district.required' => 'District is required',
            'state.required' => 'State is required',
            'dob.required' => 'Date of Birth is required',
            'country.required' => 'Country is required',
            'age.required'  => 'Age group is required',
            'vendor.required'  => 'Vendor Category is required',
            'gender.required'  => 'Gender is required',
            'subject.required'  => 'Subject is required',
            'pincode.required'  => 'Pincode is required',
            'qualification.required'  => 'Qualification is required',
            'status.required'  => 'Status is required',
            'experience.required'  => 'Experience is required',
            
      
    ];
   } 
}
