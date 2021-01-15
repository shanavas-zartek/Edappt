<?php

namespace App\Http\Requests\Studentdetails;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentdetailsRequest extends FormRequest
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
            'gender'  => ' required',
            'dob'  => ' required',
            'pincode'  => ' required',
            'dream'  => ' required',
            'status'  => ' required',
            'grade' => ' required',
            'school' => ' required',
            'student_code' => ' required',
            'syllabus' => ' required',

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
            'dob.required'  => 'Date of Birth is required',
            'gender.required'  => 'Gender is required',
            'pincode.required'  => 'Pincode is required',
           'grade.required'  => 'Grade is required',
           'school.required'  => 'School is required',
           'student_code.required'  => 'Student code is required',
           'syllabus.required'  => 'Syllabus is required',
           'dream.required'  => 'Dream is required',
            'status.required'  => 'Status is required',
            
            
      
    ];
   } 
}
