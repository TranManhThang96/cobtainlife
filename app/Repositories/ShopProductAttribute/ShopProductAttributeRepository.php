<?php

declare(strict_types=1);

namespace App\Repositories\ShopProductAttribute;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;
use Illuminate\Support\Facades\DB;

class ShopProductAttributeRepository extends RepositoryAbstract implements ShopProductAttributeRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopProductAttribute::class;
    }


    public function insertMultiple($productAttributes)
    {
        DB::table('shop_product_attributes')->insert($productAttributes);
    }

    public function deleteAttributesByProduct($productId)
    {
        return $this->model::where('product_id', $productId)->delete();
    }

}
