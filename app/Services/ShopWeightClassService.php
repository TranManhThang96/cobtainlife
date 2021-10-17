<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopWeightClass\ShopWeightClassRepositoryInterface;
use App\Services\BaseService;

class ShopWeightClassService extends BaseService
{
    protected $weightClassRepository;

    public function __construct(ShopWeightClassRepositoryInterface $weightClassRepository)
    {
        $this->weightClassRepository = $weightClassRepository;
    }

    public function index($request)
    {
        return $this->weightClassRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->weightClassRepository->all($request);
    }

    public function getAll()
    {
        return $this->weightClassRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->weightClassRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->weightClassRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->weightClassRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->weightClassRepository->delete($id);
    }
}
