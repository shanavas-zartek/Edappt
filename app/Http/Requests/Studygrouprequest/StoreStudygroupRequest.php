<?php

namespace App\Http\Requests\Studygrouprequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudygroupRequest extends FormRequest
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
            'group_name'=> 'required',
            'studentlist'=> 'required|array',
            'status'=> 'required',
           
           
        ];


    }
    public function messages()
    {
      return [
       
        'group_name.required'=> 'Group Name is required',
        'status.required'=> 'Status is required',
        'studentlist.required'=> 'Please select student',
    ];
   } 
}
