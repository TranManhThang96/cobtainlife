<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopProduct\ShopProductRepositoryInterface;
use App\Services\BaseService;

class ShopProductService extends BaseService
{
    protected $productRepository;

    public function __construct(ShopProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index($request)
    {
        return $this->productRepository->index($request);
    }

    public function search($request)
    {
        return $this->productRepository->search($request);
    }

    public function all($request = null)
    {
        return $this->productRepository->all($request);
    }

    public function getMostViewedProducts($request = null)
    {
        return $this->productRepository->getMostViewedProducts($request);
    }

    public function getNewArrivalProducts($request = null)
    {
        return $this->productRepository->getNewArrivalProducts($request);
    }

    public function getBestSellerProducts($request = null)
    {
        return $this->productRepository->getBestSellerProducts($request);
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->productRepository->create($attributes);
    }

    public function checkAliasExist($alias, $id = null)
    {
        return $this->productRepository->checkAliasExist($alias, $id);
    }

    public function getCountAliasLikeName($alias, $id = null)
    {
        return $this->productRepository->getCountAliasLikeName($alias, $id);
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->productRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function findByAlias($alias)
    {
        return $this->productRepository->findByAlias($alias);
    }

    public function relatedProducts($productId, $categoryId = null)
    {
        return $this->productRepository->relatedProducts($productId, $categoryId);
    }

    public function totalProducts()
    {
        return $this->productRepository->totalProducts();
    }

    public function updateView($productId)
    {
        return $this->productRepository->updateView($productId);
    }

    public function minusQty($qtyProducts)
    {
        foreach ($qtyProducts as $productId => $qty) {
            return $this->productRepository->minusQty($productId, $qty);
        }
    }
}
