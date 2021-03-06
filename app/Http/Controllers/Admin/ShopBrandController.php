<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ShopBrandRequest;
use App\Services\ShopBrandService;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ShopBrandController extends Controller
{
    public function __construct(
        ShopBrandService $shopBrandService
    )
    {
        $this->shopBrandService = $shopBrandService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = $this->shopBrandService->index($request);
        return view('admin.pages.brands.index', compact('brands'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $brands = $this->shopBrandService->index($request);
        $view = view('admin.pages.brands.list', compact('brands'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.brands.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopBrandRequest $request)
    {
        $params = $request->all();
        $params['name'] = ucwords(strtolower($params['name']));

        // auto create alias by name.
        $alias = Str::slug($params['name'], '-');
        $params['alias'] = $alias;

        // get the number of alias that already exist.
        $aliasExist = $this->shopBrandService->checkAliasExist($alias);
        if ($aliasExist) {
            $countAlias = $this->shopBrandService->getCountAliasLikeName($alias);
            $params['alias'] = $alias . '-' . ($countAlias + 1);
        }

        $brand = $this->shopBrandService->store($params);
        if ($brand) {
            toastr()->success('Th??m nh??n hi???u th??nh c??ng!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.brands.index');
        }
        toastr()->error('Th??m nh??n hi???u th???t b???i!', '', [
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
        $brand = $this->shopBrandService->find($id);
        return view('admin.pages.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopBrandRequest $request, $id)
    {
        $params = $request->all();
        $params['name'] = ucwords(strtolower($params['name']));

        // auto create alias by name.
        $alias = Str::slug($params['name'], '-');
        $params['alias'] = $alias;

        // get the number of alias that already exist.
        $aliasExist = $this->shopBrandService->checkAliasExist($alias, $id);
        if ($aliasExist) {
            $countAlias = $this->shopBrandService->getCountAliasLikeName($alias, $id);
            $params['alias'] = $alias . '-' . ($countAlias + 1);
        }


        $result = $this->shopBrandService->update($id, $params);
        if ($result) {
            toastr()->success('C???p nh???t nh??n hi???u th??nh c??ng!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.brands.index');
        }
        toastr()->error('C???p nh???t nh??n hi???u th???t b???i!', '', [
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
        $brand = $this->shopBrandService->find($id);
        if ($brand->products_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Kh??ng th??? x??a nh??n hi???u c?? s???n ph???m.');
        }
        $isDeleted = $this->shopBrandService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'nh??n hi???u ???? ???????c x??a');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'X??a nh??n hi???u b??? l???i');
    }
}
