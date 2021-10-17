<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopBrand\ShopBrandRepositoryInterface;
use App\Services\BaseService;

class ShopBrandService extends BaseService
{
    protected $brandRepository;

    public function __construct(ShopBrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index($request)
    {
        return $this->brandRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->brandRepository->all($request);
    }

    public function getAll()
    {
        return $this->brandRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->brandRepository->create($attributes);
    }

    public function checkAliasExist($alias, $id = null)
    {
        return $this->brandRepository->checkAliasExist($alias, $id);
    }

    public function getCountAliasLikeName($alias, $id = null)
    {
        return $this->brandRepository->getCountAliasLikeName($alias, $id);
    }

    public function find($id)
    {
        return $this->brandRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->brandRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->brandRepository->delete($id);
    }
}
