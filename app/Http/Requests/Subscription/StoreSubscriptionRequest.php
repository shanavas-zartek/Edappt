<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
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
            'package_name' => 'required',
            'start_date' => 'required',
            'amount' => 'required|integer|min:0',
            'end_date' => 'required',
            'duration' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
      return [
       'package_name.required'  => 'Plan name is required',
       'start_date.required'  => 'Start date is required',
       'amount.required'  => 'Amount is required',
       'end_date.required'  => 'End date is required',
       'duration.required'  => 'Duration is required',
       'status.required'  => 'Status is required',
    ];
}
}