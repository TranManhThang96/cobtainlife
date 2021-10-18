<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Services\DistrictService;
use App\Services\ProvinceService;
use App\Services\ShopCustomerService;
use App\Services\ShopOrderDetailService;
use App\Services\ShopOrderService;
use App\Services\ShopOrderStatusService;
use App\Services\ShopPaymentStatusService;
use App\Services\ShopProductService;
use App\Services\ShopShippingStatusService;
use App\Services\ShopTaxService;
use App\Services\WardService;
use Illuminate\Http\Request;

class ShopOrderController extends Controller
{

    public function __construct(
        DistrictService $districtService,
        ProvinceService $provinceService,
        WardService $wardService,
        ShopOrderService $shopOrderService,
        ShopOrderDetailService $shopOrderDetailService,
        ShopOrderStatusService $shopOrderStatusService,
        ShopPaymentStatusService $shopPaymentStatusService,
        ShopShippingStatusService $shopShippingStatusService,
        ShopProductService $shopProductService,
        ShopTaxService $shopTaxService
    )
    {
        $this->districtService = $districtService;
        $this->provinceService = $provinceService;
        $this->wardService = $wardService;
        $this->shopOrderService = $shopOrderService;
        $this->shopOrderDetailService = $shopOrderDetailService;
        $this->shopOrderStatusService = $shopOrderStatusService;
        $this->shopPaymentStatusService = $shopPaymentStatusService;
        $this->shopShippingStatusService = $shopShippingStatusService;
        $this->shopProductService = $shopProductService;
        $this->shopTaxService = $shopTaxService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = $this->provinceService->all();
        $listOrderStatus = $this->shopOrderStatusService->all();
        $listPaymentStatus = $this->shopPaymentStatusService->all();
        $listShippingStatus = $this->shopShippingStatusService->all();
        $products = $this->shopProductService->all();
        $listTax = $this->shopTaxService->all();
        $paymentMethods = [
            [
                'value' => Constant::PAYMENT_CASH_VALUE,
                'label' => Constant::PAYMENT_CASH_VALUE 
            ],
            // [
            //     'value' => Constant::PAYMENT_VNPAY_BASIC_VALUE,
            //     'label' => Constant::PAYMENT_VNPAY_BASIC_LABEL 
            // ],
            // [
            //     'value' => Constant::PAYMENT_PAYPAL_EXPRESS_VALUE,
            //     'label' => Constant::PAYMENT_PAYPAL_EXPRESS_LABEL 
            // ],
            // [
            //     'value' => Constant::PAYMENT_MOMO_BASIC_VALUE,
            //     'label' => Constant::PAYMENT_MOMO_BASIC_LABEL 
            // ]
        ];
        $shippingMethods = [
            [
                'value' => Constant::SHIPPING_STANDARD_VALUE,
                'label' => Constant::SHIPPING_STANDARD_LABEL 
            ],
        ];    
        return view('admin.pages.orders.add', compact(
            'provinces',
            'products',
            'listOrderStatus',
            'listPaymentStatus',
            'listShippingStatus',
            'paymentMethods',
            'shippingMethods',
            'listTax'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
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
