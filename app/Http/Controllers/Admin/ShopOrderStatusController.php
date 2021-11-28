<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopOrderStatusService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ShopOrderStatusRequest;

class ShopOrderStatusController extends Controller
{


    public function __construct(
        ShopOrderStatusService $shopOrderStatusService
    )
    {
        $this->shopOrderStatusService = $shopOrderStatusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listOrderStatus = $this->shopOrderStatusService->index($request);
        return view('admin.pages.order_status.index', compact('listOrderStatus'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $listOrderStatus = $this->shopOrderStatusService->index($request);
        $view = view('admin.pages.order_status.list', compact('listOrderStatus'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.order_status.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopOrderStatusRequest $request)
    {
        $orderStatus = $this->shopOrderStatusService->store($request->all());
        if ($orderStatus) {
            return $this->apiSendSuccess($orderStatus, Response::HTTP_CREATED, 'Thêm trạng thái thành công!');
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
        $orderStatus = $this->shopOrderStatusService->find($id);
        $view = view('admin.pages.order_status.edit', compact('orderStatus'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopOrderStatusRequest $request, $id)
    {
        $result = $this->shopOrderStatusService->update($id, $request->all());
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
        $orderStatus = $this->shopOrderStatusService->find($id);
        if ($id == 1) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa trạng thái mặc định!');
        }
        
        if ($orderStatus->orders_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa trạng thái vì có đơn hàng!');
        }
        $isDeleted = $this->shopOrderStatusService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Xóa trạng thái thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa trạng thái thất bại');
    }
}
