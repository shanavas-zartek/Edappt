<?php

namespace App\Http\Requests\Optionpolltype;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionpolltypeRequest extends FormRequest
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
            'type' => 'required',
            'status'=> 'required',
        ];
    }
    public function messages()
    {
      return [
        'type.required' => ' Option Poll Type  Name is required',
        'status.required'=> 'Status is required',
        
    ];
   } 
}
