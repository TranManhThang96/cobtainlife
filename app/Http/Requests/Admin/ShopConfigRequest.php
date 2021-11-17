<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShopConfigRequest extends FormRequest
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
            'store_facebook_url' => 'nullable|url',
            'store_twitter_url' => 'nullable|url',
            'store_instagram_url' => 'nullable|url',
            'store_youtube_url' => 'nullable|url',
            'store_email' => 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'store_facebook_url.url' => 'Vui lòng nhập đúng định dạng url.',
            'store_twitter_url.url' => 'Vui lòng nhập đúng định dạng url.',
            'store_instagram_url.url' => 'Vui lòng nhập đúng định dạng url.',
            'store_youtube_url.url' => 'Vui lòng nhập đúng định dạng url.',
            'store_email.email' => 'Vui lòng nhập đúng định dạng email.',
        ];
    }
}
