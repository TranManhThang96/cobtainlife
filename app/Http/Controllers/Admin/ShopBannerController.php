<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShopBannerRequest;
use Illuminate\Http\Request;
use App\Services\ShopBannerService;
use Symfony\Component\HttpFoundation\Response;

class ShopBannerController extends Controller
{
    public function __construct(
        ShopBannerService $shopBannerService
    )
    {
        $this->shopBannerService = $shopBannerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = $this->shopBannerService->index($request);
        return view('admin.pages.banners.index', compact('banners'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $banners = $this->shopBannerService->index($request);
        $view = view('admin.pages.banners.list', compact('banners'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.banners.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopBannerRequest $request)
    {
        $banner = $this->shopBannerService->store($request->all());
        if ($banner) {
            toastr()->success('Thêm banner thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.banners.index');
        }
        toastr()->error('Thêm banner thất bại!', '', [
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
        $banner = $this->shopBannerService->find($id);
        return view('admin.pages.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopBannerRequest $request, $id)
    {
        $params = $request->all();
        if (!isset($params['status'])) {
            $params['status'] = 0;
        }
        $result = $this->shopBannerService->update($id, $params);
        if ($result) {
            toastr()->success('Cập nhật banner thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.banners.index');
        }
        toastr()->error('Cập nhật banner thất bại!', '', [
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
        $isDeleted = $this->shopBannerService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Banner đã được xóa');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa banner bị lỗi');
    }
}
