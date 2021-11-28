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

    public function findByCode($code)
    {
        return $this->couponRepository->findByCode($code);
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

    // r = 1 không tìm thấy coupon
    // r = 2 hết lượt apply
    // r = 3 coupon không khả dụng
    // r = 4 nằm ngoài thời gian
    public function checkCoupon($couponCode, $subTotal)
    {
        $checked = [
            'r' => 0,
            'discount' => 0
        ];
        // check coupon
        $coupon = $this->findByCode($couponCode);
        if (!$coupon) {
            $checked['r'] = 1;
            return $checked;
        }
        // check coupon valid
        $validCoupon = $this->checkValidCoupon($coupon);
        if (!$validCoupon['isValid']) {
            $checked['r'] = $validCoupon['r'];
            return $checked;
        }

        // discount
        $discount = ceil((int)$subTotal * (int)$coupon['value'] / 100);
        if ($discount > $coupon['max_discount']) {
            $discount = $coupon['max_discount'];
        }
        if ($discount > $subTotal) {
            $discount = $subTotal;
        }
        $checked['discount'] = $discount;
        return $checked;
    }

    private function checkValidCoupon($coupon)
    {
        $startDb = $coupon['start'];
        $endDb = $coupon['end'];
        $nowUTC = convertDateToDateTime(date('d/m/Y'));
        $now = $nowUTC->getTimestamp();

        // check hết lượt áp dụng chưa
        if ($coupon['applied'] >= $coupon['max_applied']) {
            return [
                'isValid' => false,
                'r' => 2
            ];
        }

        // check trạng thái coupon
        if ($coupon['status'] == 0) {
            return [
                'isValid' => false,
                'r' => 3
            ];
        }

        if (!empty($startDb)) {
            $startDb = convertDateToDateTime($startDb, 'Y-m-d H:i:s');
            $startDbTimeStamp = $startDb->getTimestamp();
            if ($startDbTimeStamp > $now) {
                return [
                    'isValid' => false,
                    'r' => 4
                ];
            }
        }

        if (!empty($endDb)) {
            $endDb = convertDateToDateTime($endDb, 'Y-m-d H:i:s');
            $endDbTimeStamp = $endDb->getTimestamp() + 86400;
            if ($endDbTimeStamp < $now) {
                return [
                    'isValid' => false,
                    'r' => 4
                ];
            }
        }
        return [
            'isValid' => true
        ];
    }

    public function applyCoupon($couponCode)
    {
        return $this->couponRepository->applyCoupon($couponCode);
    }
}
