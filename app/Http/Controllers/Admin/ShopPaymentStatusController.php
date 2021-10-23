<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopPaymentStatusService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ShopPaymentStatusRequest;

class ShopPaymentStatusController extends Controller
{


    public function __construct(
        ShopPaymentStatusService $shopPaymentStatusService
    )
    {
        $this->shopPaymentStatusService = $shopPaymentStatusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listPaymentStatus = $this->shopPaymentStatusService->index($request);
        return view('admin.pages.payment_status.index', compact('listPaymentStatus'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $listPaymentStatus = $this->shopPaymentStatusService->index($request);
        $view = view('admin.pages.payment_status.list', compact('listPaymentStatus'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.payment_status.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopPaymentStatusRequest $request)
    {
        $paymentStatus = $this->shopPaymentStatusService->store($request->all());
        if ($paymentStatus) {
            return $this->apiSendSuccess($paymentStatus, Response::HTTP_CREATED, 'Thêm trạng thái thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Thêm trạng thái thất bại');
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
        $paymentStatus = $this->shopPaymentStatusService->find($id);
        $view = view('admin.pages.payment_status.edit', compact('paymentStatus'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopPaymentStatusRequest $request, $id)
    {
        $result = $this->shopPaymentStatusService->update($id, $request->all());
        if ($result) {
            return $this->apiSendSuccess($result, Response::HTTP_OK, 'Cập nhật trạng thái thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Cập nhật trạng thái thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentStatus = $this->shopPaymentStatusService->find($id);
        if ($paymentStatus->orders_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa trạng thái vì có đơn hàng!');
        }
        $isDeleted = $this->shopPaymentStatusService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Xóa trạng thái thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa trạng thái thất bại');
    }
}
