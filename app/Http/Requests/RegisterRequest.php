<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'user_tel'=>'required',
            'user_pwd'=>'regex:{4,}'
        ];
    }
    public function messages()
    {
        return [
            'user_tel.required'=>'电话不能为空',
            'user_pwd.regex'=>'密码4位以上'
        ];
    }
}
