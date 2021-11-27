<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopComment\ShopCommentRepositoryInterface;
use App\Services\BaseService;

class ShopCommentService extends BaseService
{
    protected $commentRepository;

    public function __construct(ShopCommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index($request)
    {
        return $this->commentRepository->index($request);
    }

    public function store($attributes)
    {
        return $this->commentRepository->create($attributes);
    }


    public function delete($id)
    {
        return $this->commentRepository->delete($id);
    }

    public function update($id, $attributes)
    {
        return $this->commentRepository->update($id, $attributes);
    }
    
    public function find($id)
    {
        return $this->commentRepository->find($id);
    }
}
