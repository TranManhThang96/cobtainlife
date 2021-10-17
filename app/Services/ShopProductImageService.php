<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopProductImage\ShopProductImageRepositoryInterface;
use App\Services\BaseService;

class ShopProductImageService extends BaseService
{
    protected $productImageRepository;

    public function __construct(ShopProductImageRepositoryInterface $productImageRepository)
    {
        $this->productImageRepository = $productImageRepository;
    }

    public function insertMultiple($productImages, $productId)
    {

        if (is_array($productImages)) {
            $productImagesInsert = [];
            foreach (array_unique($productImages) as $productImage) {
                if (!empty($productImage)) {
                    $productImagesInsert[] = [
                        'image' => $productImage,
                        'product_id' => $productId
                    ];
                }
            }
            if (count($productImagesInsert) > 0) {
                return $this->productImageRepository->insertMultiple($productImagesInsert);
            }
        }
    }

    public function deleteImagesByProduct($productId)
    {
        return $this->productImageRepository->deleteImagesByProduct($productId);
    }

    public function updateMultiple($productImages, $productId)
    {
        // delete before insert
        $this->deleteImagesByProduct($productId);

        // after insert multiple
        return $this->insertMultiple($productImages, $productId);
    }
}
