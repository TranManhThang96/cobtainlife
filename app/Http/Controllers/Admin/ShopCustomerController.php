<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShopCustomerRequest;
use App\Services\DistrictService;
use App\Services\ProvinceService;
use App\Services\ShopCustomerService;
use App\Services\WardService;
use App\Traits\PhoneNumber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class ShopCustomerController extends Controller
{
    public function __construct(
        DistrictService $districtService,
        ProvinceService $provinceService,
        WardService $wardService,
        ShopCustomerService $shopCustomerService
    ) {
        $this->districtService = $districtService;
        $this->provinceService = $provinceService;
        $this->wardService = $wardService;
        $this->shopCustomerService = $shopCustomerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = $this->shopCustomerService->index($request);
        return view('admin.pages.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = $this->provinceService->all();
        return view('admin.pages.customers.add', compact('provinces'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $customers = $this->shopCustomerService->index($request);
        $view = view('admin.pages.customers.list', compact('customers'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopCustomerRequest $request)
    {
        $params = $request->all();
        if ($params['password'])  {
            $params['password'] = Hash::make($params['password']);
        }
        $params['phone'] = PhoneNumber::convertVNPhoneNumber($params['phone']);

        $customer = $this->shopCustomerService->store($params);
        if ($customer) {
            toastr()->success('Thêm khách hàng thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.customers.index');
        }
        toastr()->error('Thêm khách hàng thất bại!', '', [
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
        $customer = $this->shopCustomerService->find($id);
        if ($customer) {
            $provinces = $this->provinceService->all();
            $currentProvince = $this->provinceService->find($customer->province_id);
            $districts = [];
            $wards = [];
            if ($currentProvince) {
                $districts = $currentProvince->districts;
                $currentDistrict = $this->districtService->find($customer->district_id);
                $wards = $currentDistrict->wards;
            }
            return view('admin.pages.customers.edit', compact('customer', 'provinces', 'districts', 'wards'));
        }    
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
        $params = $request->all();
        if ($params['password'])  {
            $params['password'] = Hash::make($params['password']);
        } else {
            unset($params['password']);
        } 
        $params['phone'] = PhoneNumber::convertVNPhoneNumber($params['phone']);
        
        $result = $this->shopCustomerService->update($id, $params);
        if ($result) {
            toastr()->success('Sửa khách hàng thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.customers.index');
        }
        toastr()->error('Sửa khách hàng thất bại!', '', [
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
        $customer = $this->shopCustomerService->find($id);
        if ($customer->orders_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa khách hàng có đơn hàng.');
        }
        $isDeleted = $this->shopCustomerService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Khách hàng đã được xóa');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa khách hàng bị lỗi');
    }
}
