<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopSupplier\ShopSupplierRepositoryInterface;
use App\Services\BaseService;

class ShopSupplierService extends BaseService
{
    protected $supplierRepository;

    public function __construct(ShopSupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index($request)
    {
        return $this->supplierRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->supplierRepository->all($request);
    }

    public function getAll()
    {
        return $this->supplierRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->supplierRepository->create($attributes);
    }

    public function checkAliasExist($alias, $id = null)
    {
        return $this->supplierRepository->checkAliasExist($alias, $id);
    }

    public function getCountAliasLikeName($alias, $id = null)
    {
        return $this->supplierRepository->getCountAliasLikeName($alias, $id);
    }

    public function find($id)
    {
        return $this->supplierRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->supplierRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->supplierRepository->delete($id);
    }
}
