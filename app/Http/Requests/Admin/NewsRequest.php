<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
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
     * Prepare for Validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'title' => Str::lower($this->title)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'title' => ['required', 'string', Rule::unique('shop_news')->ignore($this->title)],
                    'image' => 'required|string',
                    'content' => 'required',
                    'description' => 'required'
                ];
            case 'PUT':
                return [
                    'title' => ['required', 'string', Rule::unique('shop_news')->ignore($this->id)],
                    'image' => 'required|string',
                    'content' => 'required',
                    'description' => 'required'
                ];
            case 'PATCH':
            default:
                break;
        }
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
            case 'PUT':
                return [
                    'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
                    'title.unique' => 'Tiêu đề bài viết đã tồn tại.',
                    'description.required' => 'Vui lòng nhập mô tả ngắn gọn.',
                    'content.required' => 'Vui lòng nhập nội dung bài viết.',
                    'image.required' => 'Vui lòng upload ảnh.',
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
