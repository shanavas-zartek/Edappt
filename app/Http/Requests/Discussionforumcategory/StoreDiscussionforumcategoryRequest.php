<?php

namespace App\Http\Requests\Discussionforumcategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscussionforumcategoryRequest extends FormRequest
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
            'category_name' => 'required',
           
            'status'=> 'required',
          
           
        ];


    }
    public function messages()
    {
      return [
        'category_name.required' => ' Category Name is required',
       
        'status.required'=> 'Status is required',
        
    ];
   } 
}
