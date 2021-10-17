<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopProductPromotion\ShopProductPromotionRepositoryInterface;
use App\Services\BaseService;

class ShopProductPromotionService extends BaseService
{
    protected $productRepository;

    public function __construct(ShopProductPromotionRepositoryInterface $productPromotionRepository)
    {
        $this->productPromotionRepository = $productPromotionRepository;
    }

    public function store($productId, $price, $start, $end)
    {
        $attributes['product_id'] = $productId;
        $attributes['price_promotion'] = $price;
        $attributes['start'] = convertDateToDateTime($start);
        $attributes['end'] = convertDateToDateTime($end);
        return $this->productPromotionRepository->create($attributes);
    }

    public function updatePromotionByProduct($productId, $price, $start, $end)
    {
        $promotion = $this->productPromotionRepository->findPromotionByProduct($productId);
        $attributes['product_id'] = $productId;
        $attributes['price_promotion'] = $price;
        $attributes['start'] = convertDateToDateTime($start);
        $attributes['end'] = convertDateToDateTime($end);
        if ($promotion) {
            return $this->productPromotionRepository->update($promotion->id, $attributes);
        } else {
            return $this->productPromotionRepository->create($attributes);
        }
    }

    public function deletePromotionByProduct($productId)
    {
        return $this->productPromotionRepository->deletePromotionByProduct($productId);
    }
}
