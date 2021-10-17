<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopLengthClass\ShopLengthClassRepositoryInterface;
use App\Services\BaseService;

class ShopLengthClassService extends BaseService
{
    protected $lengthClassRepository;

    public function __construct(ShopLengthClassRepositoryInterface $lengthClassRepository)
    {
        $this->lengthClassRepository = $lengthClassRepository;
    }

    public function index($request)
    {
        return $this->lengthClassRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->lengthClassRepository->all($request);
    }

    public function getAll()
    {
        return $this->lengthClassRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->lengthClassRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->lengthClassRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->lengthClassRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->lengthClassRepository->delete($id);
    }
}
