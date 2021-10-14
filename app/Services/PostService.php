<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\post\PostRepositoryInterface;
use App\Services\BaseService;

class PostService extends BaseService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index($params)
    {
        return $this->postRepository->index($params);
    }

    public function search($params)
    {
        return $this->postRepository->search($params);
    }

    public function getAll()
    {
        return $this->postRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->postRepository->create($attributes);
    }

    public function getCountSlugLikeName($slug, $id = null)
    {
        return $this->postRepository->getCountSlugLikeName($slug, $id);
    }

    public function find($id)
    {
        return $this->postRepository->findById($id);
    }

    public function update($id, $attributes)
    {
        return $this->postRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }

    public function findBySlug($slug)
    {
        return $this->postRepository->findBySlug($slug);
    }
}
