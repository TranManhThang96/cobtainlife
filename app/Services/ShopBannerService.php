<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopBanner\ShopBannerRepositoryInterface;
use App\Services\BaseService;

class ShopBannerService extends BaseService
{
    protected $bannerRepository;

    public function __construct(ShopBannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index($request)
    {
        return $this->bannerRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->bannerRepository->all($request);
    }

    public function getAll()
    {
        return $this->bannerRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->bannerRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->bannerRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->bannerRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->bannerRepository->delete($id);
    }
}
