<?php

namespace App\Http\Requests\Learning;

use Illuminate\Foundation\Http\FormRequest;

class StoreLearningContentRequest extends FormRequest
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
    public function rules()
    {

        return [ 
            'category_id' => 'required',
            'ld_file'=> 'required_without:ld_file1|mimes:jpeg,png,jpg,gif,svg,bmp,mpeg,mpga,mp3,wav,aac,mp4,mov,ogg,qt|max:30000',
            'status' => 'required',
        ];


    }
    public function messages()
    {
      return [
        'category_id.required' => 'Please select a catergory',
        'ld_file.required_without' => 'Please upload image or audio or video ',
       'status.required'  => 'Status is required',
    ];
   } 
}

