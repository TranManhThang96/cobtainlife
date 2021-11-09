<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopNews\ShopNewsRepositoryInterface;
use App\Services\BaseService;

class ShopNewsService extends BaseService
{
    protected $newsRepository;

    public function __construct(ShopNewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index($request)
    {
        return $this->newsRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->newsRepository->all($request);
    }

    public function getAll()
    {
        return $this->newsRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->newsRepository->create($attributes);
    }

    public function checkAliasExist($alias, $id = null)
    {
        return $this->newsRepository->checkAliasExist($alias, $id);
    }

    public function getCountAliasLikeName($alias, $id = null)
    {
        return $this->newsRepository->getCountAliasLikeName($alias, $id);
    }

    public function find($id)
    {
        return $this->newsRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->newsRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->newsRepository->delete($id);
    }

    public function findByAlias($alias)
    {
        return $this->newsRepository->findByAlias($alias);
    }

    public function archives() 
    {
        return $this->newsRepository->archives();
    }

    public function recentNews($request) 
    {
        return $this->newsRepository->recentNews($request);
    }

    public function totalNews()
    {
        return $this->newsRepository->totalNews();
    }
}
