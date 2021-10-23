<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ShopOrderProducts implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_array($value)) {
            if (array_key_exists('#index', $value)) {
                unset($value['#index']);
            }
            return count($value) > 0;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Vui lòng thêm sản phẩm vào đơn hàng. ';
    }
}
