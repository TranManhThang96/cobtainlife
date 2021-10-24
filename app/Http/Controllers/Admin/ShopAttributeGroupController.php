<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopAttributeGroupService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\ShopAttributeGroupRequest;

class ShopAttributeGroupController extends Controller
{


    public function __construct(
        ShopAttributeGroupService $shopAttributeGroupService
    )
    {
        $this->shopAttributeGroupService = $shopAttributeGroupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listAttributeGroup = $this->shopAttributeGroupService->index($request);
        return view('admin.pages.attribute_group.index', compact('listAttributeGroup'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $listAttributeGroup = $this->shopAttributeGroupService->index($request);
        $view = view('admin.pages.attribute_group.list', compact('listAttributeGroup'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.attribute_group.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopAttributeGroupRequest $request)
    {
        $attributeGroup = $this->shopAttributeGroupService->store($request->all());
        if ($attributeGroup) {
            return $this->apiSendSuccess($attributeGroup, Response::HTTP_CREATED, 'Thêm nhóm thuộc tính thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Thêm nhóm thuộc tính thất bại');
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
        $attributeGroup = $this->shopAttributeGroupService->find($id);
        $view = view('admin.pages.attribute_group.edit', compact('attributeGroup'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopAttributeGroupRequest $request, $id)
    {
        $result = $this->shopAttributeGroupService->update($id, $request->all());
        if ($result) {
            return $this->apiSendSuccess($result, Response::HTTP_OK, 'Cập nhật nhóm thuộc tính thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Cập nhật nhóm thuộc tính thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->shopAttributeGroupService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Xóa nhóm thuộc tính thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa nhóm thuộc tính thất bại');
    }
}
