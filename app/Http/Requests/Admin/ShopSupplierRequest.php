<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ShopSupplierRequest extends FormRequest
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
            // 'name' => Str::lower($this->name)
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
                    'name' => ['required', Rule::unique('shop_suppliers')->ignore($this->name)->whereNull('deleted_at')],
                ];
            case 'PUT':
                return [
                    'name' => ['required', Rule::unique('shop_suppliers')->ignore($this->id)->whereNull('deleted_at')],
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
                    'name.required' => 'Vui lòng nhập tên nhà cung cấp.',
                    'name.unique' => 'Tên nhà cung cấp đã tồn tại.',
                ];
            case 'PUT':
                return [
                    'name.required' => 'Vui lòng nhập tên nhà cung cấp.',
                    'name.unique' => 'Tên nhà cung cấp đã tồn tại.',
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
