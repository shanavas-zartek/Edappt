<?php

namespace App\Http\Requests\userrole;

use Illuminate\Foundation\Http\FormRequest;


class storeUserRoleRequest extends FormRequest
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
            'role_name' => 'required|unique:roles,name,'.$this->role_id,
            'status'=> 'required',
            'role_permission'=> 'required',
        ];


    }
    public function messages()
    {
      return [
        'role_name.required' => 'Role name is required',
        'status.required'=> 'Status is required',
        'role_permission.required' => 'Please select a permission'
    ];
   } 
}
