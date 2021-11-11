<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ShopCommentRequest extends FormRequest
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
            'customer_email' => 'required|email',
            'comment' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Vui lòng nhập họ và tên',
            'customer_email.required' => 'Vui lòng nhập email',
            'customer_email.email' => 'Vui lòng nhập đúng định dạng email',
            'comment.required' => 'Vui lòng nhập bình luận',
        ];
    }
}
