<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (isset($this->type) && ($this->type) == 1) {
            return [
                'email' => ['required', 'email', Rule::unique('shop_customer_subscribes')->ignore($this->email)->whereNull('deleted_at')],
                'name' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'content' => 'required'
            ];
        }
        return [
            'email' => ['required', 'email', Rule::unique('shop_customer_subscribes')->ignore($this->email)->whereNull('deleted_at')],
        ];
    }

    public function messages()
    {
        if (isset($this->type) && ($this->type) == 1) {
            return [
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Vui lòng nhập đúng định dạng email.',
                'email.unique' => 'Email đã tồn tại.',
                'name.required' => 'Vui lòng nhập tên của bạn.',
                'phone.required' => 'Vui lòng nhập số điện thoại của bạn.',
                'phone.regex' => 'Vui lòng nhập đúng định dạng điện thoại',
                'content.required' => 'Vui lòng nhập nội dung lời nhắn.',
            ];
        }
        return [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'email.unique' => 'Email đã tồn tại.'
        ];
    }
}
