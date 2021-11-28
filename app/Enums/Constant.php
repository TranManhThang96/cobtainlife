<?php

namespace App\Enums;

use App\Enums\BaseEnum;

/**
 * Constant enum.
 */
class Constant extends BaseEnum
{
    // page
    const START_PAGE = 1;

    const DEFAULT_PER_PAGE = 10;

    // result
    const SUCCESS = 1;

    const FAILURE = 0;

    // log level

    const DEBUG = 1;

    const INFO = 2;

    const WARNING = 3;

    const ERROR = 4;

    // sorting
    const SORT_BY_ASC = 'ASC';
    const SORT_BY_DESC = 'DESC';


    // category level
    const NO_PARENT = 'ROOT';

    
    // product
    const NO_CATEGORY = 'Chọn danh mục';

    // [order] shipping method 
    const SHIPPING_STANDARD_VALUE = 'ShippingStandard';
    const SHIPPING_STANDARD_LABEL = 'ShippingStandard';

    // [order] payment method
    const PAYMENT_SHIPCODE_VALUE = 'ShipCode';
    const PAYMENT_CASH_LABEL = 'Thanh toán tiền mặt';
    const PAYMENT_VNPAY_BASIC_VALUE = 'VnpayBasic';
    const PAYMENT_VNPAY_BASIC_LABEL = 'VnpayBasic';
    const PAYMENT_PAYPAL_EXPRESS_VALUE = 'PaypalExpress';
    const PAYMENT_PAYPAL_EXPRESS_LABEL = 'PaypalExpress';
    const PAYMENT_MOMO_BASIC_VALUE = 'MomoBasic';
    const PAYMENT_MOMO_BASIC_LABEL = 'MOMO payment basic';
}
