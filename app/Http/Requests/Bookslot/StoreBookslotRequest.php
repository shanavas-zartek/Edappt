<?php

namespace App\Http\Requests\Bookslot;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookslotRequest extends FormRequest
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
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'approval_status'=> 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
      return [
       'start_date.required'  => 'Start date is required',
       'start_time.required'  => 'Start time is required',
       'end_time.required'  => 'End time is required',
       'approval_status.required'  => 'Approval status is required',
       'status.required'  => 'Status is required',
    ];
}
}
