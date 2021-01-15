<?php

namespace App\Http\Requests\Discussionforumdtl;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscussionforumdtlRequest extends FormRequest
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
            
            'status'=> 'required',
            'approved_status'=> 'required',
           
        ];


    }
    public function messages()
    {
      return [
       
        'status.required'=> 'Status is required',
        'approved_status.required'=> 'Approval Status is required',
        
    ];
   } 
}
