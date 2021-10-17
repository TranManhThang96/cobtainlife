<?php

declare(strict_types=1);

namespace App\Repositories\ShopProductPromotion;

use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;

class ShopProductPromotionRepository extends RepositoryAbstract implements ShopProductPromotionRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopProductPromotion::class;
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function findPromotionByProduct($productId)
    {
        return $this->model::where('product_id', $productId)->first();
    }

    public function deletePromotionByProduct($productId)
    {
        return $this->model::where('product_id', $productId)->delete();
    }
}
