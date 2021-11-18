<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopCoupon\ShopCouponRepositoryInterface;
use App\Services\BaseService;

class ShopCouponService extends BaseService
{
    protected $couponRepository;

    public function __construct(ShopCouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function all()
    {
        return $this->couponRepository->all();
    }

    public function store($attributes)
    {
        $couponCode = $this->createCouponCode();
        $attributes['code'] = $couponCode;
        $attributes['start'] = convertDateToDateTime($attributes['start'] ?? null);
        $attributes['end'] = convertDateToDateTime($attributes['end'] ?? null);
        return $this->couponRepository->create($attributes);
    }

    private function createCouponCode()
    {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $coupon = "";
        for ($i = 0; $i < 10; $i++) {
            $coupon .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $coupon;
    }

    public function index($request)
    {
        return $this->couponRepository->index($request);
    }

    public function find($id)
    {
        return $this->couponRepository->find($id);
    }

    public function update($id, $attributes)
    {
        $attributes['start'] = convertDateToDateTime($attributes['start'] ?? null);
        $attributes['end'] = convertDateToDateTime($attributes['end'] ?? null);
        return $this->couponRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->couponRepository->delete($id);
    }
}
