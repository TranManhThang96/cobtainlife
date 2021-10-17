<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShopCategoryRequest;
use Illuminate\Http\Request;
use App\Services\ShopCategoryService;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ShopCategoryController extends Controller
{
    protected $shopCategoryService;

    public function __construct(ShopCategoryService $shopCategoryService)
    {
        $this->shopCategoryService = $shopCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->shopCategoryService->index($request);
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $categories = $this->shopCategoryService->index($request);
        $view = view('admin.pages.categories.list', compact('categories'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = [];
        $allCategories = $this->shopCategoryService->all();
        showCategories($allCategories, $categories);
        return view('admin.pages.categories.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ShopCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopCategoryRequest $request)
    {
        $params = $request->all();
        $params['title'] = ucwords(strtolower($params['title']));

        // auto create alias by name.
        $alias = Str::slug($params['title'], '-');
        $params['alias'] = $alias;

        // get the number of alias that already exist.
        $aliasExist = $this->shopCategoryService->checkAliasExist($alias);
        if ($aliasExist) {
            $countAlias = $this->shopCategoryService->getCountAliasLikeName($alias);
            $params['alias'] = $alias . '-' . ($countAlias + 1);
        }

        $category = $this->shopCategoryService->store($params);
        if ($category) {
            toastr()->success('Thêm danh mục thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.categories.index');
        }
        toastr()->error('Thêm danh mục thất bại!', '', [
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
        $category = $this->shopCategoryService->find($id);
        $categories = [];
        $allCategories = $this->shopCategoryService->all();
        showCategories($allCategories, $categories);
        return view('admin.pages.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ShopCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopCategoryRequest $request, $id)
    {
        $params = $request->all();
        $params['title'] = ucwords(strtolower($params['title']));

        // auto create alias by name.
        $alias = Str::slug($params['title'], '-');
        $params['alias'] = $alias;

        // get the number of alias that already exist.
        $aliasExist = $this->shopCategoryService->checkAliasExist($alias, $id);
        if ($aliasExist) {
            $countAlias = $this->shopCategoryService->getCountAliasLikeName($alias, $id);
            $params['alias'] = $alias . '-' . ($countAlias + 1);
        }

        // check top, status
        if (!isset($params['top'])) {
            $params['top'] = 0;
        }

        if (!isset($params['status'])) {
            $params['status'] = 0;
        }

        $result = $this->shopCategoryService->update($id, $params);
        if ($result) {
            toastr()->success('Sửa danh mục thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.categories.index');
        }
        toastr()->error('Sửa danh mục thất bại!', '', [
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
        $category = $this->shopCategoryService->find($id);
        if ($category->products_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa danh mục có sản phẩm.');
        } else if ($category->categories_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa danh mục có danh mục con.');
        }
        $isDeleted = $this->shopCategoryService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Danh mục đã được xóa');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa danh mục bị lỗi');
    }
}
