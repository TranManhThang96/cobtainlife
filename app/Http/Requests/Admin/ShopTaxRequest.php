<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ShopTaxRequest extends FormRequest
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
                    'name' => ['required', Rule::unique('shop_tax')->ignore($this->name)],
                    'value' => ['required', 'numeric', 'max: 100', Rule::unique('shop_tax')->ignore($this->value)],
                ];
            case 'PUT':
                return [
                    'name' => ['required', Rule::unique('shop_tax')->ignore($this->id)],
                    'value' => ['required', 'numeric', Rule::unique('shop_tax')->ignore($this->id)],
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
                    'name.required' => 'Vui lòng nhập tên.',
                    'name.unique' => 'Tên đã tồn tại.',
                    'value.required' => 'Vui lòng nhập giá trị.',
                    'value.unique' => 'Giá trị đã tồn tại.',
                    'value.numeric' => 'Vui lòng nhập giá trị nguyên dương',
                ];
            case 'PUT':
                return [
                    'name.required' => 'Vui lòng nhập tên đơn vị.',
                    'name.unique' => 'Đơn vị đã tồn tại.',
                    'value.required' => 'Vui lòng nhập giá trị.',
                    'value.unique' => 'Giá trị đã tồn tại.',
                    'value.numeric' => 'Vui lòng nhập giá trị nguyên dương',
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
