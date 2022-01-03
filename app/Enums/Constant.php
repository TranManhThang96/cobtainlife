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

    // [humidity - do am]
    const HUMIDITY = [
        'low' => [
            'title' => 'Thấp',
            'value' => 1
        ],
        'medium' => [
            'title' => 'Vừa',
            'value' => 2
        ],
        'high' => [
            'title' => 'Cao',
            'value' => 3
        ]
    ];

    // [light- anh sang]
    const LIGHT = [
        'low' => [
            'title' => 'Ít',
            'value' => 1,
        ],
        'medium' => [
            'title' => 'Vừa',
            'value' => 2,
        ],
        'low' => [
            'title' => 'Nhiều',
            'value' => 3,
        ],
    ];

    // [water - luong nuoc]
    const WATER = [
        'very_low' => [
            'title' => 'Rất ít',
            'value' => 1
        ],
        'low' => [
            'title' => 'Ít',
            'value' => 2
        ],
        'medium' => [
            'title' => 'Vừa',
            'value' => 3
        ],
        'high' => [
            'title' => 'Nhiều',
            'value' => 4
        ],
    ];

    // [price filter]
    const PRICE_FILTER = [
        [
            'title' => '0 - 200,000',
            'min' => 0,
            'max' => 200000
        ],
        [
            'title' => '200,000 - 500,000',
            'min' => 200000,
            'max' => 500000
        ],
        [
            'title' => '500,000 - 1,000,000',
            'min' => 500000,
            'max' => 1000000
        ],
        [
            'title' => '1,000,000 - 2,000,000',
            'min' => 1000000,
            'max' => 2000000
        ],
        [
            'title' => 'Trên 2 triệu',
            'min' => 2000000,
        ],
    ];
}
