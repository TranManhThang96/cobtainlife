<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopLengthClassService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ShopLengthClassRequest;

class ShopLengthClassController extends Controller
{


    public function __construct(
        ShopLengthClassService $shopLengthClassService
    )
    {
        $this->shopLengthClassService = $shopLengthClassService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listLengthClass = $this->shopLengthClassService->index($request);
        return view('admin.pages.length_class.index', compact('listLengthClass'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $listLengthClass = $this->shopLengthClassService->index($request);
        $view = view('admin.pages.length_class.list', compact('listLengthClass'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.length_class.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopLengthClassRequest $request)
    {
        $lengthClass = $this->shopLengthClassService->store($request->all());
        if ($lengthClass) {
            return $this->apiSendSuccess($lengthClass, Response::HTTP_CREATED, 'Thêm đơn vị thành công!');
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
        $lengthClass = $this->shopLengthClassService->find($id);
        $view = view('admin.pages.length_class.edit', compact('lengthClass'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopLengthClassRequest $request, $id)
    {
        $result = $this->shopLengthClassService->update($id, $request->all());
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
        $isDeleted = $this->shopLengthClassService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Xóa đơn vị thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa đơn vị thất bại');
    }
}
