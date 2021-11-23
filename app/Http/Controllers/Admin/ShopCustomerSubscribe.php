<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopCustomerSubscribeService;
use Symfony\Component\HttpFoundation\Response;

class ShopCustomerSubscribe extends Controller
{
    public function __construct(
        ShopCustomerSubscribeService $shopCustomerSubscribeService
    ) {
        $this->shopCustomerSubscribeService = $shopCustomerSubscribeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = $this->shopCustomerSubscribeService->index($request);
        return view('admin.pages.customer_subscribes.index', compact('customers'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $customers = $this->shopCustomerSubscribeService->index($request);
        $view = view('admin.pages.customer_subscribes.list', compact('customers'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function status(Request $request)
    {
        $customers = $request->customers;
        $isSuccess = $this->shopCustomerSubscribeService->changeStatus($customers);
        if ($isSuccess) {
            return $this->apiSendSuccess($isSuccess, Response::HTTP_OK, 'Chuyển trạng thái thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Chuyển trạng thái thất bại!');
    }
}
