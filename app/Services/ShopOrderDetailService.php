<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopOrderDetail\ShopOrderDetailRepositoryInterface;
use App\Services\BaseService;

class ShopOrderDetailService extends BaseService
{
    protected $shopOrderDetailRepository;

    public function __construct(ShopOrderDetailRepositoryInterface $shopOrderDetailRepository)
    {
        $this->shopOrderDetailRepository = $shopOrderDetailRepository;
    }

    public function index($request)
    {
        return $this->shopOrderDetailRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopOrderDetailRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopOrderDetailRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopOrderDetailRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopOrderDetailRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopOrderDetailRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopOrderDetailRepository->delete($id);
    }

    public function insert($listOrderDetail)
    {
        return $this->shopOrderDetailRepository->insert($listOrderDetail);
    }
}
