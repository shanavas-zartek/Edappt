<?php

namespace App\Http\Requests\Subjects;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectsRequest extends FormRequest
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
            'subject' => 'required',
            'status'=> 'required',
           
           
        ];


    }
    public function messages()
    {
      return [
        'subject.required' => ' Subject is required',
        'status.required'=> 'Status is required',
       
    ];
   } 
}
