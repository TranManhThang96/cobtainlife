<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ShopCategoryRequest extends FormRequest
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
            'name' => Str::lower($this->name)
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
                    'title' => ['required', Rule::unique('shop_categories')->ignore($this->title)],
                    'parent' => 'numeric',
                    'image' => 'string|nullable',
                    'description' => 'string|nullable'
                ];
            case 'PUT':
                return [
                    'title' => ['nullable', Rule::unique('shop_categories')->ignore($this->id)],
                    'image' => 'string|nullable',
                    'description' => 'string|nullable'
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
                return [
                    'title.required' => 'Vui lòng nhập tên danh mục.',
                    'title.unique' => 'Tên danh mục đã tồn tại.',
                ];
            case 'PUT':
                return [
                    'title.unique' => 'Tên danh mục đã tồn tại.',
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
