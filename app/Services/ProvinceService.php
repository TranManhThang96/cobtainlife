<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Services\BaseService;

class ProvinceService extends BaseService
{
    protected $provinceRepository;

    public function __construct(ProvinceRepositoryInterface $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }

    public function index($request)
    {
        return $this->provinceRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->provinceRepository->all($request);
    }

    public function getAll()
    {
        return $this->provinceRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->provinceRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->provinceRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->provinceRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->provinceRepository->delete($id);
    }
}
