<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopOrderStatus\ShopOrderStatusRepositoryInterface;
use App\Services\BaseService;

class ShopOrderStatusService extends BaseService
{
    protected $shopOrderStatusRepository;

    public function __construct(ShopOrderStatusRepositoryInterface $shopOrderStatusRepository)
    {
        $this->shopOrderStatusRepository = $shopOrderStatusRepository;
    }

    public function index($request)
    {
        return $this->shopOrderStatusRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopOrderStatusRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopOrderStatusRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopOrderStatusRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopOrderStatusRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopOrderStatusRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopOrderStatusRepository->delete($id);
    }
}
