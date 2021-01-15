<?php

namespace App\Http\Requests\CourseDetails;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseDetailsRequest extends FormRequest
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
            'course_master_id' => 'required',
            'course_detail_title' => 'required',            
            'video_content_file'=> 'required',
            'status' => 'required',
        ];
    }
    public function messages()
    {
      return [
        'course_master_id.required' => 'Please select a Course',
        'course_detail_title.required' => 'Please input the Title',
        'video_content_file.required' => 'Please upload the video ',
        'status.required'  => 'Status is required',
    ];
   } 
}

