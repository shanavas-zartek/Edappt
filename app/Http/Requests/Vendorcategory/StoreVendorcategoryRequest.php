<?php

namespace App\Http\Requests\Vendorcategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorcategoryRequest extends FormRequest
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
            'category' => 'required',
            'status'=> 'required',
            'icon_image'=> 'required_without:image1',
        ];


    }
    public function messages()
    {
      return [
        'category.required' => ' Category is required',
        'status.required'=> 'Status is required',
      
    ];
   } 
}
