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
            'name'=>'required|max:500',
            'description'=>'required',
            'category_id'=>'required|numeric',
            'short_des' =>'required|max:500'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name không được để trống',
            'name.max' => 'Name không được nhiều hơn 500 ký tự',
            'description' => 'Description không được để trống',
            'Thể loại' => 'Thể loại không được để trống',
            'short_des' => 'Short Description không được để trống',
            'short_des.max' => 'Short Description không được nhiều hơn 500 ký tự',
        ];
    }
}
