<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopShippingStatus\ShopShippingStatusRepositoryInterface;
use App\Services\BaseService;

class ShopShippingStatusService extends BaseService
{
    protected $shopShippingStatusRepository;

    public function __construct(ShopShippingStatusRepositoryInterface $shopShippingStatusRepository)
    {
        $this->shopShippingStatusRepository = $shopShippingStatusRepository;
    }

    public function index($request)
    {
        return $this->shopShippingStatusRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopShippingStatusRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopShippingStatusRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopShippingStatusRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopShippingStatusRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopShippingStatusRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopShippingStatusRepository->delete($id);
    }
}
