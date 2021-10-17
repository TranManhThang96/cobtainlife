<?php

declare(strict_types=1);

namespace App\Repositories\ShopProductImage;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;
use Illuminate\Support\Facades\DB;

class ShopProductImageRepository extends RepositoryAbstract implements ShopProductImageRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopProductImage::class;
    }

    public function insertMultiple($productImages)
    {
        DB::table('shop_product_images')->insert($productImages);
    }

    public function deleteImagesByProduct($productId)
    {
        return $this->model::where('product_id', $productId)->delete();
    }
}
