<?php

namespace App\Http\Requests\Agegroup;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgegroupRequest extends FormRequest
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
            'age_group' => 'required',
            'status' => 'required',
        ];


    }
    public function messages()
    {
      return [
       'age_group.required'  => 'Age Group is required',
      
       'status.required'  => 'Status is required',
    ];
}
}
