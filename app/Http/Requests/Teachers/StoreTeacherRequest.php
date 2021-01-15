<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            
            'email' => 'required|unique:teachers,email,'.$this->teacher_id,

            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'age'  => ' required',
            'gender'  => ' required',
            'pincode'  => ' required',
            'subject'  => ' required',
            'qualification'  => ' required',
            'status'  => ' required',
            'experience'=> ' required',
            'district' => 'required',
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
            'phone.required' => 'Phone number is required',
            'address.required' => 'Address is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'country.required' => 'Country is required',
            'age.required'  => 'Age group is required',
            'gender.required'  => 'Gender is required',
            'subject.required'  => 'Subject is required',
            'pincode.required'  => 'Pincode is required',
            'qualification.required'  => 'Qualification is required',
            'status.required'  => 'Status is required',
            'experience.required'  => 'Experience is required',
            'password.required'  => 'Password is required',
            'district.required' => 'District is required',
                
    ];
   } 
}
