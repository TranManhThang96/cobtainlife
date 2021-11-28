<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopShippingStatusService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ShopShippingStatusRequest;

class ShopShippingStatusController extends Controller
{


    public function __construct(
        ShopShippingStatusService $shopShippingStatusService
    )
    {
        $this->shopShippingStatusService = $shopShippingStatusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listShippingStatus = $this->shopShippingStatusService->index($request);
        return view('admin.pages.shipping_status.index', compact('listShippingStatus'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $listShippingStatus = $this->shopShippingStatusService->index($request);
        $view = view('admin.pages.shipping_status.list', compact('listShippingStatus'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.shipping_status.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopShippingStatusRequest $request)
    {
        $shippingStatus = $this->shopShippingStatusService->store($request->all());
        if ($shippingStatus) {
            return $this->apiSendSuccess($shippingStatus, Response::HTTP_CREATED, 'Thêm trạng thái thành công!');
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
        $shippingStatus = $this->shopShippingStatusService->find($id);
        $view = view('admin.pages.shipping_status.edit', compact('shippingStatus'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopShippingStatusRequest $request, $id)
    {
        $result = $this->shopShippingStatusService->update($id, $request->all());
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
        $shippingStatus = $this->shopShippingStatusService->find($id);
        if ($id == 1) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa trạng thái mặc định!');
        }
        
        if ($shippingStatus->orders_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa trạng thái vì có đơn hàng!');
        }
        $isDeleted = $this->shopShippingStatusService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Xóa trạng thái thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa trạng thái thất bại');
    }
}
