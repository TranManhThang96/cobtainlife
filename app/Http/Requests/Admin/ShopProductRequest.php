<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ShopProductRequest extends FormRequest
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
            'name' => Str::lower($this->name)
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
                    'name' => ['required', Rule::unique('shop_products')->ignore($this->name)],
                    'image' => 'required|string',
                    'description' => 'string|nullable',
                    'category_id' => 'required|numeric',
                    'content' => 'required',
                    'cost' => 'nullable',
                    'price' => 'nullable',
                    'price_promotion' => 'nullable',
                    'stock' => 'numeric|nullable',
                    'weight' => 'numeric|nullable',
                    'length' => 'numeric|nullable',
                    'height' => 'numeric|nullable',
                    'width' => 'numeric|nullable'
                ];
            case 'PUT':
                return [
                    'name' => ['required', Rule::unique('shop_products')->ignore($this->id)],
                    'image' => 'required|string',
                    'description' => 'string|nullable',
                    'category_id' => 'required|numeric',
                    'content' => 'required',
                    'cost' => 'nullable',
                    'price' => 'nullable',
                    'price_promotion' => 'nullable',
                    'stock' => 'numeric|nullable',
                    'weight' => 'numeric|nullable',
                    'length' => 'numeric|nullable',
                    'height' => 'numeric|nullable',
                    'width' => 'numeric|nullable'
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
