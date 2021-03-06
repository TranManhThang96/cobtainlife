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
                    'phone' => ['required', Rule::unique('shop_customers')->ignore($this->phone)->whereNull('deleted_at')],
                    'email' => ['nullable', 'email', Rule::unique('shop_customers')->ignore($this->email)->whereNull('deleted_at')],
                    'province_id' => 'nullable|numeric',
                    'district_id' => 'nullable|numeric',
                    'ward_id' => 'nullable|numeric',
                    'address' => 'nullable|string',
                    'password' => 'nullable|min:6'
                ];
            case 'PUT':
                return [
                    'name' => ['required'],
                    'phone' => ['required', Rule::unique('shop_customers')->ignore($this->id)->whereNull('deleted_at')],
                    'email' => ['nullable', 'email', Rule::unique('shop_customers')->ignore($this->id)->whereNull('deleted_at')],
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
                    'name.required' => 'Vui l??ng nh???p t??n kh??ch h??ng.',
                    'phone.required' => 'Vui l??ng nh???p s??? ??i???n tho???i.',
                    'phone.unique' => 'S??? ??i???n tho???i ???? t???n t???i.',
                    'email.unique' => 'Email ???? t???n t???i',
                    'password.min' => 'M???t kh???u ??t nh???t 6 k?? t???.',
                ];
            case 'PUT':
                return [
                    'name.required' => 'Vui l??ng nh???p t??n kh??ch h??ng.',
                    'phone.required' => 'Vui l??ng nh???p s??? ??i???n tho???i.',
                    'phone.unique' => 'S??? ??i???n tho???i ???? t???n t???i.',
                    'email.unique' => 'Email ???? t???n t???i',
                    'password.min' => 'M???t kh???u ??t nh???t 6 k?? t???.',
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
