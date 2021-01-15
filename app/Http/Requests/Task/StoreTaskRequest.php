<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'task_name' => 'required',
            'age'  => ' required',
            'status'=> ' required',
            'start_date'=> ' required',
            'end_date'=> ' required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
      return [
        'task_name.required' => ' Task Name is required',
        'status.required'=> 'Status is required',
        'age.required'=> 'Age Group is required',
        'start_date.required'=> 'Start  Date is required',
        'end_date.required'=> 'End  Date is required',
    ];
}
}
