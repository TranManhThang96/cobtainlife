<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ShopSupplierRequest;
use App\Services\ShopSupplierService;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ShopSupplierController extends Controller
{
    public function __construct(
        ShopSupplierService $shopSupplierService
    )
    {
        $this->shopSupplierService = $shopSupplierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = $this->shopSupplierService->index($request);
        return view('admin.pages.suppliers.index', compact('suppliers'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $suppliers = $this->shopSupplierService->index($request);
        $view = view('admin.pages.suppliers.list', compact('suppliers'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.suppliers.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopSupplierRequest $request)
    {
        $params = $request->all();
        $params['name'] = ucwords(strtolower($params['name']));

        // auto create alias by name.
        $alias = Str::slug($params['name'], '-');
        $params['alias'] = $alias;

        // get the number of alias that already exist.
        $aliasExist = $this->shopSupplierService->checkAliasExist($alias);
        if ($aliasExist) {
            $countAlias = $this->shopSupplierService->getCountAliasLikeName($alias);
            $params['alias'] = $alias . '-' . ($countAlias + 1);
        }

        $supplier = $this->shopSupplierService->store($params);
        if ($supplier) {
            toastr()->success('Thêm nhà cung cấp thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.suppliers.index');
        }
        toastr()->error('Thêm nhà cung cấp thất bại!', '', [
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
        $supplier = $this->shopSupplierService->find($id);
        return view('admin.pages.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopSupplierRequest $request, $id)
    {
        $params = $request->all();
        $params['name'] = ucwords(strtolower($params['name']));

        // auto create alias by name.
        $alias = Str::slug($params['name'], '-');
        $params['alias'] = $alias;

        // get the number of alias that already exist.
        $aliasExist = $this->shopSupplierService->checkAliasExist($alias, $id);
        if ($aliasExist) {
            $countAlias = $this->shopSupplierService->getCountAliasLikeName($alias, $id);
            $params['alias'] = $alias . '-' . ($countAlias + 1);
        }


        $result = $this->shopSupplierService->update($id, $params);
        if ($result) {
            toastr()->success('Sửa nhà cung cấp thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.suppliers.index');
        }
        toastr()->error('Sửa nhà cung cấp thất bại!', '', [
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
        $supplier = $this->shopSupplierService->find($id);
        if ($supplier->products_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa nhà cung cấp có sản phẩm.');
        }
        $isDeleted = $this->shopSupplierService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Nhà cung cấp đã được xóa');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa nhà cung cấp bị lỗi');
    }
}
