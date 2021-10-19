<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ShopOrderProducts;
use Illuminate\Support\Str;

class ShopOrderRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'customer_name' => 'required',
                    'phone' => 'numeric',
                    'email' => 'nullable|email',
                    'province_id' => 'required|numeric',
                    'district_id' => 'required|numeric',
                    'ward_id' => 'required|numeric',
                    'address' => 'required|string',
                    'product_id' => [new ShopOrderProducts]
                ];
            case 'PUT':
                return [
                    'customer_name' => 'required',
                    'phone' => 'required|numeric',
                    'email' => 'nullable|email',
                    'province_id' => 'required|numeric',
                    'ward_id' => 'required|numeric',
                    'district_id' => 'required|numeric',
                    'address' => 'required|string',
                    'product_id' => [new ShopOrderProducts]
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
