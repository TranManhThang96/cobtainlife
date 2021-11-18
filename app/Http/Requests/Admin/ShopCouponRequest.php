<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShopCouponRequest extends FormRequest
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
                    'name' => 'required',
                    'value' => 'required|min:1|max:100',
                    'max_discount' => 'required',
                    'max_applied' => 'required',
                ];
            case 'PUT':
                return [
                    'name' => 'required',
                    'value' => 'required|min:1|max:100',
                    'max_discount' => 'required',
                    'max_applied' => 'required',
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
                    'name.required' => 'Vui lòng nhập tên coupon.',
                    'value.required' => 'Vui lòng nhập giá trị coupon.',
                    'value.min' => 'Giá trị coupon từ 1 đến 100.',
                    'value.max' => 'Giá trị coupon từ 1 đến 100.',
                    'max_discount.required' => 'Vui lòng nhập giảm giá tối đa.',
                    'max_applied.required' => 'Vui lòng nhập số lượt áp dụng tối đa.',
                ];
            case 'PUT':
                return [
                    'name.required' => 'Vui lòng nhập tên coupon.',
                    'value.required' => 'Vui lòng nhập giá trị coupon.',
                    'value.min' => 'Giá trị coupon từ 1 đến 100.',
                    'value.max' => 'Giá trị coupon từ 1 đến 100.',
                    'max_discount.required' => 'Vui lòng nhập giảm giá tối đa.',
                    'max_applied.required' => 'Vui lòng nhập số lượt áp dụng tối đa.',
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
