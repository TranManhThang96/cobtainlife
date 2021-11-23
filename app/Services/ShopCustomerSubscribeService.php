<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopCustomerSubscribe\ShopCustomerSubscribeRepositoryInterface;
use App\Services\BaseService;
class ShopCustomerSubscribeService extends BaseService
{
    protected $shopCustomerSubscribeRepository;

    public function __construct(ShopCustomerSubscribeRepositoryInterface $shopCustomerSubscribeRepository)
    {
        $this->shopCustomerSubscribeRepository = $shopCustomerSubscribeRepository;
    }

    public function index($request)
    {
        return $this->shopCustomerSubscribeRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopCustomerSubscribeRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopCustomerSubscribeRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopCustomerSubscribeRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopCustomerSubscribeRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopCustomerSubscribeRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopCustomerSubscribeRepository->delete($id);
    }

    public function changeStatus($customers)
    {
        return $this->shopCustomerSubscribeRepository->changeStatus($customers);
    }
}
