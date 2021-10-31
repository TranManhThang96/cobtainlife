<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'customer_name' => 'required',
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'email' => 'nullable|email',
            'province_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'ward_id' => 'required|numeric',
            'address' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Vui lòng nhập họ và tên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Vui lòng nhập đúng số điện thoại',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'province_id.required' => 'Vui lòng chọn tỉnh/thành',
            'province_id.numeric' => 'Vui lòng chọn tỉnh/thành',
            'district_id.required' => 'Vui lòng chọn quận/huyện',
            'district_id.numeric' => 'Vui lòng chọn quận/huyện',
            'ward_id.required' => 'Vui lòng chọn xã/phường',
            'ward_id.numeric' => 'Vui lòng chọn xã/phường',
            'address.required' => 'Vui lòng điền địa chỉ cụ thể',
        ];
    }
}
