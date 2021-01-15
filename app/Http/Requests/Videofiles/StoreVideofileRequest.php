<?php

namespace App\Http\Requests\Videofiles;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideofileRequest extends FormRequest
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
            'video_title' => 'required',
            'video_file_name' => 'required_without:old_video_file_name|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv| max:20000',
            'category_id'       => 'required',
            'age_group_id'       => 'required',
            'status'=> 'required',
        ];
    }
    public function messages()
    {
      return [
        'video_title.required' => ' Title is required',
        'video_file_name.required' => ' Video is required',
        'category_id.required'=> 'Please select a category',
        'age_group_id.required'=> 'Please select age group',
        'status.required'=> 'Status is required',
        
    ];
   } 
}
