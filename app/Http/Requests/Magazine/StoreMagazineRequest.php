<?php

namespace App\Http\Requests\Magazine;

use Illuminate\Foundation\Http\FormRequest;

class StoreMagazineRequest extends FormRequest
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
            'title' => 'required',
            'poster_image' => 'required',
            'pdf_file' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
      return [
       'title.required' => 'Please input the Magazine title',
       'poster_image.required'  => 'Please add the poster image',
       'pdf_file.required'  => 'Please upload the PDF file',
       'status.required'  => 'Status is required',
    ];
   } 
}
