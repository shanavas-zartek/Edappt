<?php

namespace App\Http\Requests\Learning;

use Illuminate\Foundation\Http\FormRequest;

class StoreLearningCategoryRequest extends FormRequest
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
            'category' => 'required',
            'age_group_id'  => ' required',
            'status' => 'required',
        ];


    }
    public function messages()
    {
      return [
        'category' => 'required',
       'age_group_id.required'  => 'Age group is required',
       'status.required'  => 'Status is required',
    ];
   } 
}
