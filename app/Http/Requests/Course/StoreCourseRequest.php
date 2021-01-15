<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'course_name' => 'required',
            'ld_category_id'  => ' required',
            'age_group_id'  => ' required',
            'poster_image'  => ' required',
            'course_price'  => ' required',
            'status' => 'required',
        ];


    }
    public function messages()
    {
      return [
        'course_name.required' => 'Please enter the Course Name',
        'ld_category_id.required'  => 'Please select a Category',
       'age_group_id.required'  => 'Please select the Age group',
       'poster_image.required'  => 'Please add a Preview Video',
       'course_price.required'  => 'Please enter the Course Price',
       'status.required'  => 'Please select the Status',
    ];
   } 
}
