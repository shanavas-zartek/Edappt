<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminBlogsRequest extends FormRequest
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
            'blog_title' => 'required',
            'published_from' => 'required',
            'published_to' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
      return [
       'blog_title.required'  => 'Blog title is required',
       'published_from.required'  => 'Publish from date is required',
       'published_to.required'  => 'Publish to date is required',
       'status.required'  => 'Status is required',
    ];
}
}
