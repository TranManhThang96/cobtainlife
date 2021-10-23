<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopOrder\ShopOrderRepositoryInterface;
use App\Services\BaseService;

class ShopOrderService extends BaseService
{
    protected $shopOrderRepository;

    public function __construct(ShopOrderRepositoryInterface $shopOrderRepository)
    {
        $this->shopOrderRepository = $shopOrderRepository;
    }

    public function index($request)
    {
        return $this->shopOrderRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopOrderRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopOrderRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopOrderRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopOrderRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopOrderRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopOrderRepository->delete($id);
    }
}
