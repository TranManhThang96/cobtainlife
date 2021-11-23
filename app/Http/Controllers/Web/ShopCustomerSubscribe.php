<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ShopCustomerRequest;
use App\Services\ShopCustomerSubscribeService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopCustomerSubscribe extends Controller
{

    public function __construct(
        ShopCustomerSubscribeService $shopCustomerSubscribeService
    )
    {
        $this->shopCustomerSubscribeService = $shopCustomerSubscribeService;   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopCustomerRequest $request)
    {
        $customerSubscribe = $this->shopCustomerSubscribeService->store($request->all());
        $type = 'Đăng ký';
        if (isset($request->type) && ($request->type) == 1) {
            $type = 'Liên hệ';
        }
        if ($customerSubscribe) {
            return $this->apiSendSuccess($customerSubscribe, Response::HTTP_CREATED, $type . ' thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, $type . ' thất bại!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
