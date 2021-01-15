<?php

namespace App\Http\Requests\Contentcategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentcategoryRequest extends FormRequest
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
            'age'  => ' required',
            'status'=> 'required',
            'day'=> 'required',
           
        ];


    }
    public function messages()
    {
      return [
        'category.required' => ' Category Name is required',
        'age.required'  => 'Age group is required',
        'status.required'=> 'Status is required',
        'day.required'=> 'Day is required',
    ];
   } 
}
