<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopTaxService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ShopTaxRequest;

class ShopTaxController extends Controller
{


    public function __construct(
        ShopTaxService $shopTaxService
    )
    {
        $this->shopTaxService = $shopTaxService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listTax = $this->shopTaxService->index($request);
        return view('admin.pages.tax.index', compact('listTax'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $listTax = $this->shopTaxService->index($request);
        $view = view('admin.pages.tax.list', compact('listTax'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.tax.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopTaxRequest $request)
    {
        $tax = $this->shopTaxService->store($request->all());
        if ($tax) {
            return $this->apiSendSuccess($tax, Response::HTTP_CREATED, 'Thêm đơn vị thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Thêm đơn vị thất bại');
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
        $tax = $this->shopTaxService->find($id);
        $view = view('admin.pages.tax.edit', compact('tax'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopTaxRequest $request, $id)
    {
        $result = $this->shopTaxService->update($id, $request->all());
        if ($result) {
            return $this->apiSendSuccess($result, Response::HTTP_OK, 'Cập nhật đơn vị thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Cập nhật đơn vị thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->shopTaxService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Xóa đơn vị thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa đơn vị thất bại');
    }
}
