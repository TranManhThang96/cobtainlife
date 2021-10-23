<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopWeightClassService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ShopWeightClassRequest;

class ShopWeightClassController extends Controller
{


    public function __construct(
        ShopWeightClassService $shopWeightClassService
    )
    {
        $this->shopWeightClassService = $shopWeightClassService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listWeightClass = $this->shopWeightClassService->index($request);
        return view('admin.pages.weight_class.index', compact('listWeightClass'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $listWeightClass = $this->shopWeightClassService->index($request);
        $view = view('admin.pages.weight_class.list', compact('listWeightClass'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.weight_class.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopWeightClassRequest $request)
    {
        $weightClass = $this->shopWeightClassService->store($request->all());
        if ($weightClass) {
            return $this->apiSendSuccess($weightClass, Response::HTTP_CREATED, 'Thêm đơn vị thành công!');
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
        $weightClass = $this->shopWeightClassService->find($id);
        $view = view('admin.pages.weight_class.edit', compact('weightClass'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopWeightClassRequest $request, $id)
    {
        $result = $this->shopWeightClassService->update($id, $request->all());
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
        $isDeleted = $this->shopWeightClassService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Xóa đơn vị thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa đơn vị thất bại');
    }
}
