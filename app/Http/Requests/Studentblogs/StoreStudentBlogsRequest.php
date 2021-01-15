<?php

namespace App\Http\Requests\Studentblogs;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentBlogsRequest extends FormRequest
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
            
            'published_from' => 'required',
            'published_to' => 'required',
            'approval_status'=> 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
      return [
       'approval_status.required'  => 'Approval Status is required',
       'published_from.required'  => 'Publish from date is required',
       'published_to.required'  => 'Publish to date is required',
       'status.required'  => 'Status is required',
    ];
}
}
