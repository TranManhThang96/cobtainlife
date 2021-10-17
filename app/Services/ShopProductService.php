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

    public function all($request = null)
    {
        return $this->productRepository->all($request);
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
}
