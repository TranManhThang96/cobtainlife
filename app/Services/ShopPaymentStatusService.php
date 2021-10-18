<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopPaymentStatus\ShopPaymentStatusRepositoryInterface;
use App\Services\BaseService;

class ShopPaymentStatusService extends BaseService
{
    protected $shopPaymentStatusRepository;

    public function __construct(ShopPaymentStatusRepositoryInterface $shopPaymentStatusRepository)
    {
        $this->shopPaymentStatusRepository = $shopPaymentStatusRepository;
    }

    public function index($request)
    {
        return $this->shopPaymentStatusRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopPaymentStatusRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopPaymentStatusRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopPaymentStatusRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopPaymentStatusRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopPaymentStatusRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopPaymentStatusRepository->delete($id);
    }
}
