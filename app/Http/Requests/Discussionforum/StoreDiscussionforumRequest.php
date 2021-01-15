<?php

namespace App\Http\Requests\Discussionforum;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscussionforumRequest extends FormRequest
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
            'discussion_category_id' => 'required',
            'topic' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status'=> 'required',
          
           
        ];


    }
    public function messages()
    {
      return [
        'discussion_category_id.required' => ' Category Name is required',
        'topic.required' => ' Topic is required',
        'start_date.required' => ' Start Date is required',
        'end_date.required' => ' End Date is required',
        'status.required'=> 'Status is required',
        
    ];
   } 
}
