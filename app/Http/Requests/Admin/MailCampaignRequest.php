<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MailCampaignRequest extends FormRequest
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
        $pressMail = false;
        if (isset($this->campaign_press_mail)) {
            $pressMail = true;
        }
        return [
            'subject' => 'required',
            'body' => 'required',
            'to' => $pressMail ? 'required' : '',
            'campaign_to_types' => !$pressMail ? 'required' : ''
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'subject.required' => 'Vui lòng nhập chủ đề',
            'body.required' => 'Vui lòng nhập nội dung',
            'to.required' => 'Vui lòng nhập email và ngăn cách bởi dấu ;',
            'campaign_to_types.required' => 'Vui lòng chọn khách hàng'
        ];
    }
}
