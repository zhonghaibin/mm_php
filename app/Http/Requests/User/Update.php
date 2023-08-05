<?php

namespace App\Http\Requests\User;

use App\Rules\ValidateName;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'name' => ['required', new ValidateName],
            'email' => 'required|string|email|max:255|unique:users,email,'
                .$this->route()->id,
            'roles' => 'required',
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '用户名',
            'email' => '邮箱',
            'roles' => '角色',
        ];
    }
}
