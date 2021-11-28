<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ShopCouponService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopCouponController extends Controller
{
    public function __construct(
        ShopCouponService $shopCouponService
    )
    {
        $this->shopCouponService = $shopCouponService;
    }

    public function checkCoupon(Request $request)
    {
        $couponCode = $request->coupon;
        $subTotal = $request->subTotal;
        $checked = $this->shopCouponService->checkCoupon($couponCode, $subTotal);
        if ($checked) {
            return $this->apiSendSuccess($checked, Response::HTTP_OK);
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Có lỗi xảy ra!');
    }
}
