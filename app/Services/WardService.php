<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Ward\WardRepositoryInterface;
use App\Services\BaseService;

class WardService extends BaseService
{
    protected $wardClassRepository;

    public function __construct(WardRepositoryInterface $wardClassRepository)
    {
        $this->wardClassRepository = $wardClassRepository;
    }

    public function index($request)
    {
        return $this->wardClassRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->wardClassRepository->all($request);
    }

    public function getAll()
    {
        return $this->wardClassRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->wardClassRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->wardClassRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->wardClassRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->wardClassRepository->delete($id);
    }
}
