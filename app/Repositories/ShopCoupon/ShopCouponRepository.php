<?php

declare(strict_types=1);

namespace App\Repositories\ShopCoupon;

use App\Repositories\RepositoryAbstract;
use App\Enums\Constant;

class ShopCouponRepository extends RepositoryAbstract implements ShopCouponRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopCoupon::class;
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;

        return $this->model
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function findByCode($code)
    {
        return $this->model::where('code', $code)->first();
    }

    public function applyCoupon($couponCode)
    {
        $coupon =  $this->model::where('code', $couponCode)->first();
        if ($coupon) {
            $attributes = [
                'applied' => $coupon['applied'] + 1
            ];
            return $coupon->update($attributes);
        }
        return false;
    }
}
