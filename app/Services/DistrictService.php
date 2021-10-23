<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\District\DistrictRepositoryInterface;
use App\Services\BaseService;

class DistrictService extends BaseService
{
    protected $districtRepository;

    public function __construct(DistrictRepositoryInterface $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    public function index($request)
    {
        return $this->districtRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->districtRepository->all($request);
    }

    public function getAll()
    {
        return $this->districtRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->districtRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->districtRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->districtRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->districtRepository->delete($id);
    }
}
