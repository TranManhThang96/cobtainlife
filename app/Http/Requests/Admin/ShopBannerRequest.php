<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShopBannerRequest extends FormRequest
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
                    'image' => 'required',
                ];
            case 'PUT':
                return [
                    'image' => 'required',
                ];
            case 'PATCH':
            default:
                break;
        }
    }

    public function messages()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'image.required' => 'Hình ảnh là bắt buộc.',
                ];
            case 'PUT':
                return [
                    'image.required' => 'Hình ảnh là bắt buộc.',
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
