<?php

namespace App\Http\Requests\DSAdetails;

use Illuminate\Foundation\Http\FormRequest;

class StoreDSAdetailsRequest extends FormRequest
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
            'alternate_no' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'district'  => ' required',
            
            'pincode'  => ' required',
           
            'status'  => ' required',
            'password'=> ' required',
            'confirm_password' =>  'required|same:password'
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
            'alternate_no.required' => 'Alternate number is required',
            'city.required' => 'City is required',
            'district.required' => 'District is required',
            'state.required' => 'State is required',
           
            'country.required' => 'Country is required',
           
            'pincode.required'  => 'Pincode is required',
            
            'status.required'  => 'Status is required',
            'password.required'  => 'Password is required',
            
      
    ];
   } 
}
