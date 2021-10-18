<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopTax\ShopTaxRepositoryInterface;
use App\Services\BaseService;

class ShopTaxService extends BaseService
{
    protected $shopTaxRepository;

    public function __construct(ShopTaxRepositoryInterface $shopTaxRepository)
    {
        $this->shopTaxRepository = $shopTaxRepository;
    }

    public function index($request)
    {
        return $this->shopTaxRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopTaxRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopTaxRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopTaxRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopTaxRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopTaxRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopTaxRepository->delete($id);
    }
}
