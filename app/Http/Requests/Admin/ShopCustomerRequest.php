<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Traits\PhoneNumber;

class ShopCustomerRequest extends FormRequest
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
            'phone' => PhoneNumber::convertVNPhoneNumber($this->phone)
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
                    'name' => ['required'],
                    'phone' => ['required', Rule::unique('shop_customers')->ignore($this->phone)],
                    'email' => ['nullable', 'email', Rule::unique('shop_customers')->ignore($this->email)],
                    'province_id' => 'nullable|numeric',
                    'district_id' => 'nullable|numeric',
                    'ward_id' => 'nullable|numeric',
                    'address' => 'nullable|string',
                    'password' => 'nullable|min:6'
                ];
            case 'PUT':
                return [
                    'name' => ['required'],
                    'phone' => ['required', Rule::unique('shop_customers')->ignore($this->id)],
                    'email' => ['nullable', 'email', Rule::unique('shop_customers')->ignore($this->id)],
                    'province_id' => 'nullable|numeric',
                    'district_id' => 'nullable|numeric',
                    'ward_id' => 'nullable|numeric',
                    'address' => 'nullable|string',
                    'password' => 'nullable|min:6'
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
                    'name.required' => 'Vui lòng nhập tên khách hàng.',
                    'phone.required' => 'Vui lòng nhập số điện thoại.',
                    'phone.unique' => 'Số điện thoại đã tồn tại.',
                    'email.unique' => 'Email đã tồn tại',
                    'password.min' => 'Mật khẩu ít nhất 6 ký tự.',
                ];
            case 'PUT':
                return [
                    'name.required' => 'Vui lòng nhập tên khách hàng.',
                    'phone.required' => 'Vui lòng nhập số điện thoại.',
                    'phone.unique' => 'Số điện thoại đã tồn tại.',
                    'email.unique' => 'Email đã tồn tại',
                    'password.min' => 'Mật khẩu ít nhất 6 ký tự.',
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
