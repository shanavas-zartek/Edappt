<?php

namespace App\Http\Requests\Contentcategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentDetailsRequest extends FormRequest
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
            'name' => 'required',
            'status'=> 'required',
            'duration'=> 'required',
            'content_category_id'=> 'required',
            'subject_id'=> 'required',
            ];
    }
    public function messages()
    {
      return [
        'name.required' => 'Name is required',
        'status.required'=> 'Status is required',
        'duration.required'=> 'Duration is required',
        'content_category_id.required'=> 'Content category is required',
        'subject_id.required'=> 'Subject is required',
    ];
   } 
}
