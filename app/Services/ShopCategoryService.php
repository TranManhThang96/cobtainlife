<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopCategory\ShopCategoryRepositoryInterface;
use App\Services\BaseService;

class ShopCategoryService extends BaseService
{
    protected $categoryRepository;

    public function __construct(ShopCategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index($request)
    {
        return $this->categoryRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->categoryRepository->all($request);
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->categoryRepository->create($attributes);
    }

    public function checkAliasExist($alias, $id = null)
    {
        return $this->categoryRepository->checkAliasExist($alias, $id);
    }

    public function getCountAliasLikeName($alias, $id = null)
    {
        return $this->categoryRepository->getCountAliasLikeName($alias, $id);
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->categoryRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
