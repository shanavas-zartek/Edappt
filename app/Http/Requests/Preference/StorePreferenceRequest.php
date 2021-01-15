<?php

namespace App\Http\Requests\Preference;

use Illuminate\Foundation\Http\FormRequest;

class StorePreferenceRequest extends FormRequest
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
            'age'  => ' required',
            'status' => 'required',
        ];


    }
    public function messages()
    {
      return [
        'category_name.required' => 'Category Name is required',
       'age.required'  => 'Age group is required',
       'status.required'  => 'Status is required',
    ];
   } 
}
