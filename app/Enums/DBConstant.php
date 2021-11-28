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
}
