<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'       => 'required',
            'sapo'        => 'required',
            'content'     => 'required',
            'user_id'     => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => 'A title is required',
            'slug.required'        => 'A slug is required',
            'sapo.required'        => 'A sapo is required',
            'content.required'     => 'A content is required',
            'user_id.required'     => 'A user is required',
            'category_id.required' => 'A category is required',
        ];
    }
}
