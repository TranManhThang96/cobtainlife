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

}
