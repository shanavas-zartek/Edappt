<?php

namespace App\Http\Requests\Demovideo;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemoVideoRequest extends FormRequest
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
            'demo_video' => 'required_without:old_demo_video|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv| max:20000',
            'status'=> 'required',
        ];
    }
    public function messages()
    {
      return [
        'title.required' => ' Title is required',
        'demo_video.required' => ' Video is required',
        'status.required'=> 'Status is required',
        
    ];
   } 
}
