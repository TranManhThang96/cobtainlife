<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShopConfigRequest;
use App\Services\ShopConfigService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ShopConfigController extends Controller
{
    public function __construct(ShopConfigService $shopConfigService)
    {
        $this->shopConfigService = $shopConfigService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allConfigs = $this->shopConfigService->all();
        $configs = (object) array_column($allConfigs->toArray(), null, 'key');
        return view('admin.pages.configs.index', compact('configs'));
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
    public function store(ShopConfigRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->shopConfigService->save($request->all());
            DB::commit();
            return $this->apiSendSuccess(null, Response::HTTP_OK, 'Lưu cấu hình thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Lưu cấu hình thất bại!');
            DB::rollBack();
        }
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
