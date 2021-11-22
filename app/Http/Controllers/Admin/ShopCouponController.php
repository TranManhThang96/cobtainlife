<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShopCouponRequest;
use App\Services\ShopCouponService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopCouponController extends Controller
{
    public function __construct(
        ShopCouponService $shopCouponService
    ) {
        $this->shopCouponService = $shopCouponService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coupons = $this->shopCouponService->index($request);
        return view('admin.pages.coupons.index', compact('coupons'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $coupons = $this->shopCouponService->index($request);
        $view = view('admin.pages.coupons.list', compact('coupons'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.coupons.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopCouponRequest $request)
    {
        $coupon = $this->shopCouponService->store($request->all());
        if ($coupon) {
            toastr()->success('Thêm mã giảm giá thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.coupons.index');
        }
        toastr()->error('Thêm mã giảm giá thất bại!', '', [
            'positionClass' => 'toast-top-center',
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = $this->shopCouponService->find($id);
        return view('admin.pages.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopCouponRequest $request, $id)
    {
        $params = $request->all();
        if (!isset($params['status'])) {
            $params['status'] = 0;
        }
        $result = $this->shopCouponService->update($id, $params);

        if ($result) {
            toastr()->success('Sửa mã giảm giá thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.coupons.index');
        }
        toastr()->error('Sửa mã giảm giá thất bại!', '', [
            'positionClass' => 'toast-top-center',
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = $this->shopCouponService->find($id);
        if ($coupon->applied > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa mã giảm giá vì nó đã được sử dụng.');
        }
        $isDeleted = $this->shopCouponService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Mã giảm giá đã được xóa');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa Mã giảm giá bị lỗi');
    }
}
