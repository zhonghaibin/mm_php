<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'category_id' => 'required|string',
            'title' => 'required|string',
            'author' => 'required|string',
            'keywords' => 'required|string',
            'tag_ids' => 'required',
            'content' => 'required|string',
            'status' => 'required',
            'is_top' => 'required',
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
            'category_id' => '分类',
            'title' => '标题',
            'author' => '作者',
            'tag_ids' => '标签',
            'keywords' => '关键词',
            'content' => '内容',
            'status' => '状态',
            'is_top' => '置顶',
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tag_ids.required' => '必须选择标签',
        ];
    }
}
