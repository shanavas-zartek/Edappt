<?php

namespace App\Http\Requests\Audiofiles;

use Illuminate\Foundation\Http\FormRequest;

class StoreAudiofileRequest extends FormRequest
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
            'audio_title' => 'required',
            'audio_file_name' => 'required_without:old_audio_file_name|mimes:mpeg,mpga,mp3,wav,aac| max:20000',
           
            'status'=> 'required',
        ];
    }
    public function messages()
    {
      return [
        'audio_title.required' => ' Title is required',
        'audio_file_name.required' => ' Audio is required',
       
        'status.required'=> 'Status is required',
        
    ];
   } 
}
