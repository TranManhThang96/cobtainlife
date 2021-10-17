<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopAttributeGroup\ShopAttributeGroupRepositoryInterface;
use App\Services\BaseService;

class ShopAttributeGroupService extends BaseService
{
    protected $attributeGroupRepository;

    public function __construct(ShopAttributeGroupRepositoryInterface $attributeGroupRepository)
    {
        $this->attributeGroupRepository = $attributeGroupRepository;
    }

    public function index($request)
    {
        return $this->attributeGroupRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->attributeGroupRepository->all($request);
    }

    public function getAll()
    {
        return $this->attributeGroupRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->attributeGroupRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->attributeGroupRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->attributeGroupRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->attributeGroupRepository->delete($id);
    }
}
