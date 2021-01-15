<?php

namespace App\Http\Requests\Parentdetail;

use Illuminate\Foundation\Http\FormRequest;

class StoreParentdetailRequest extends FormRequest
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
            'contact_no' => 'required',
            'address' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'mobile_verified_status' => 'required',
            'alternate_no' => 'required',
            'pincode'  => ' required',
            'alternate_no' => 'required',
            'status'  => ' required',
            
        ];
    }
    public function messages()
    {
      return [
       'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'contact_no.required' => 'Contact number is required',
            'address.required' => 'Address is required',
            'district.required' => 'District is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'country.required' => 'Country is required',
            'mobile_verified_status.required'  => 'Mobile Verified Status is required',
            'alternate_no.required' => 'Alternate number is required',
           
            'pincode.required'  => 'Pincode is required',
           
            'status.required'  => 'Status is required',
            
            
      
    ];
   } 
}
