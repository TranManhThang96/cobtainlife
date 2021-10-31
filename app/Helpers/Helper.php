<?php

use Illuminate\Support\Str;

if (!function_exists('showCategories')) {
    function showCategories($categories, &$result = [], $parent = \App\Enums\DBConstant::NO_PARENT, $char = '')
    {
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent == $parent) {
                $countSymbol = count(explode('/', $char));
                $result[] = array_merge(
                    $item->toArray(),
                    [
                        'full_path' => $char . Str::slug($item->title),
                        'label' => str_pad($item->title, strlen($item->title) + ($countSymbol - 1) * 4, "--- ", STR_PAD_LEFT),
                        'level' => $countSymbol,
                    ]
                );

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $result, $item['id'], $char . Str::slug($item->title) . ' / ');
            }
        }
    }
}

if (!function_exists('getParent')) {
    function getParent($str = '', $id, $symbol = '')
    {
        // $model = new Category();
        // $currentCate = $model->find($id);
        // $str = $currentCate->name . $symbol;
        // if ($currentCate->parent_id == 0) {
        //     return $str;
        // } else {
        //     $str = getParent($str, $currentCate->parent_id, '-->') . $str;
        // }
        // return $str;
    }
}

if (!function_exists('renderBreadcrumb')) {
    function renderBreadcrumb($pageTitle = '', $breadcrumb = [])
    {
        $countBreadcrumb = count($breadcrumb);
        if ($pageTitle && $countBreadcrumb === 0) {
            return;
        }
        echo '<div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">';
        if ($pageTitle) {
            echo '<h4 class="page-title">' . $pageTitle . '</h4>';
        }
        if ($countBreadcrumb) {
            echo '<div class="ml-auto text-right"><nav aria-label="breadcrumb"><ol class="breadcrumb">';
            foreach ($breadcrumb as $key => $brc) {
                echo '<li class="breadcrumb-item"><a href="' . $brc['link'] . '">' . $brc['name'] . '</a></li>';
            }
            echo '<li class="breadcrumb-item active" aria-current="page">' . $pageTitle . '</li></ol></nav></div>';
        }
        echo '</div></div></div>';
    }
}

if (!function_exists('renderCategoryName')) {
    function renderCategoryName($name, $level = null)
    {
        if (is_null($level)) {
            echo '<div class="px-1 py-1">' . $name . '</div>';
            return;
        }
        $distance = (int)($level - 1) * 30;
        echo '<div class="px-1 py-1 text-white float-right" style="background-color: ' . \App\Enums\Constant::LEVEL_COLORS[$level] . '; width: calc(100% - ' . $distance . 'px)">' . $name . '</div>';
    }
}

if (!function_exists('convertDateToDateTime')) {
    function convertDateToDateTime($value, $format = '!d/m/Y')
    {
        if (!empty($value)) {
            return \DateTime::createFromFormat($format, $value, new \DateTimeZone('UTC'));
        }
        return null;
    }
}

if (!function_exists('convertStringToNumber')) {
    function convertStringToNumber($stringNumber)
    {
        if (is_string($stringNumber)) {
            $number = floatval(str_replace(',', '', $stringNumber));
            return $number;
        } else if (is_numeric($stringNumber)) {
            return $stringNumber;
        }
        return 0;
    }
}

if (!function_exists('sc_clean')) {
    /**
     * Clear data
     */
    function sc_clean($data = null, $exclude = [], $level_hight = null)
    {
        if ($level_hight) {
            if (is_array($data)) {
                $data = array_map(function ($v) {
                    return strip_tags($v);
                }, $data);
            } else {
                $data = strip_tags($data);
            }
        }
        if (is_array($data)) {
            array_walk($data, function (&$v, $k) use ($exclude, $level_hight) {
                if (is_array($v)) {
                    $v = sc_clean($v, $exclude, $level_hight);
                } else {
                    if ((is_array($exclude) && in_array($k, $exclude)) || (!is_array($exclude) && $k == $exclude)) {
                        $v = $v;
                    } else {
                        $v = htmlspecialchars_decode($v);
                        $v = htmlspecialchars($v, ENT_COMPAT, 'UTF-8');
                    }
                }
            });
        } else {
            $data = htmlspecialchars_decode($data);
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }
        return $data;
    }
}
