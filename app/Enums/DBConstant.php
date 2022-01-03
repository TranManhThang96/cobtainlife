<?php
namespace App\Enums;
use App\Enums\BaseEnum;

/**
 * DBConstant enum.
 */
class DBConstant extends BaseEnum
{
    // [categories]
    const NO_PARENT = 0;
    const SHOW_TOP = 1;

    // [products]
    const NO_CATEGORY = 0;
    const PRODUCT_NEW_ARRIVAL = 1;
    const PRODUCT_HOT = 1;

    // [comments]
    const PRODUCT_COMMENT = 1;
    const NEWS_COMMENT = 2;
    const NO_COMMENT_PARENT = 0;
    const SHOW_COMMENT = 1;
    const HIDDEN_COMMENT = 0;

    // status
    const ON = 1;
    const OFF = 0;

    // [humidity - do am]
    const LOW_HUMIDITY = 1;
    const MEDIUM_HUMIDITY = 2;
    const HIGH_HUMIDITY = 3;

    // [light- anh sang]
    const LOW_LIGHT = 1;
    const MEDIUM_LIGHT = 2;
    const HIGH_LIGHT = 3;

    // [water - luong nuoc]
    const VERY_LOW_WATER = 1;
    const LOW_WATER = 2;
    const MEDIUM_WATER = 3;
    const HIGH_WATER = 4;
}
