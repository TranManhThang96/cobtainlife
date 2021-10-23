<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopCustomer\ShopCustomerRepositoryInterface;
use App\Services\BaseService;

class ShopCustomerService extends BaseService
{
    protected $shopCustomerRepository;

    public function __construct(ShopCustomerRepositoryInterface $shopCustomerRepository)
    {
        $this->shopCustomerRepository = $shopCustomerRepository;
    }

    public function index($request)
    {
        return $this->shopCustomerRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopCustomerRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopCustomerRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopCustomerRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopCustomerRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopCustomerRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopCustomerRepository->delete($id);
    }
}
