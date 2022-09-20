<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required|unique:users||min:5|max:100',
            'email'=>'required|unique:users|max:255',
            'password'=>'required|min:6|max:20',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password không đủ ký tự',
            'password.max' => 'Password không được nhiều hơn 20 ký tự',
            'name.required' => 'Name không được để trống',
            'name.min' => 'Name không được ít hơn 5 ý tự',
            'name.max' => 'Name không được nhiều hơn 100 ký tự',
        ];
    }
}
