<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShopOrderRequest;
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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        ShopTaxService $shopTaxService,
        ShopCustomerService $shopCustomerService
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
        $this->shopCustomerService = $shopCustomerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->shopOrderService->index($request);
        $listOrderStatus = $this->shopOrderStatusService->all();
        return view('admin.pages.orders.index', compact('orders', 'listOrderStatus'));
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
        $paymentMethods = $this->getPaymentMethods();
        $shippingMethods = $this->getShippingMethods();
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
        DB::beginTransaction();
        try {
            $params = $request->all();
            // insert order
            $params['customer_id'] = $this->shopCustomerService->getCustomerByPhoneOrEmail($request);
            
            $orderInserted = $this->shopOrderService->store($params);
            // insert order detail
            foreach($params['product_id'] as $key=>$productId) {
                if (!empty($productId)) {
                    $orderProducts[] = [
                        'order_id' => $orderInserted->id,
                        'product_id' => $productId,
                        'product_name' => $params['product_name'][$key],
                        'product_sku' => $params['product_sku'][$key],
                        'price' => convertStringToNumber($params['product_price'][$key]),
                        'qty' => convertStringToNumber($params['product_qty'][$key]),
                        'attribute' => $params['product_attribute'][$key],
                        'created_at' => new \DateTime(),
                        'updated_at' => new \DateTime(),
                    ];
                }
            }
            $this->shopOrderDetailService->insert($orderProducts);
            DB::commit();
            if (true) {
                toastr()->success('Thêm đơn hàng thành công!', '', [
                    'positionClass' => 'toast-top-center',
                ]);
                return redirect()->route('admin.orders.index');
            } 
        } catch(Exception $e) {
            Log::error($e->getMessage());
            toastr()->error('Thêm đơn hàng thất bại!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->back()->withInput();
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
        $order = $this->shopOrderService->find($id);
        $paymentMethods = $this->getPaymentMethods();
        $shippingMethods = $this->getShippingMethods();
        return view('admin.pages.orders.show', compact(
            'order',
            'paymentMethods',
            'shippingMethods',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->shopOrderService->find($id);
        $provinces = $this->provinceService->all();
        $currentProvince = $this->provinceService->find($order['province_id']);
        $districts = [];
        $wards = [];
        if ($currentProvince) {
            $districts = $currentProvince->districts;
            $currentDistrict = $this->districtService->find($order['district_id']);
            $wards = $currentDistrict->wards;
        }
        $listOrderStatus = $this->shopOrderStatusService->all();
        $listPaymentStatus = $this->shopPaymentStatusService->all();
        $listShippingStatus = $this->shopShippingStatusService->all();
        $products = $this->shopProductService->all();
        $listTax = $this->shopTaxService->all();
        $paymentMethods = $this->getPaymentMethods();
        $shippingMethods = $this->getShippingMethods();
        return view('admin.pages.orders.edit', compact(
            'provinces',
            'districts',
            'wards',
            'order',
            'listOrderStatus',
            'listPaymentStatus',
            'listShippingStatus',
            'products',
            'listTax',
            'paymentMethods',
            'shippingMethods',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Admin\ShopOrderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopOrderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();

            // update order
            $updated = $this->shopOrderService->update($id, $params);
            if (!$updated) {
                throw new Exception('order update failed!');
            }
            
            // insert or update or delete order detail
            $order = $this->shopOrderService->find($id);
            $orderDetailIdInserted = $order->orders->pluck('id')->toArray();
            $orderDetailIdDelete = array_diff($orderDetailIdInserted, $params['order_detail_id']);

            $orderProducts = [];
            foreach($params['order_detail_id'] as $key=>$orderDetailId) {
                if (!empty($orderDetailId)) {
                    $orderUpdateProduct = [
                        'order_id' => $id,
                        'product_id' => $params['product_id'][$key],
                        'product_name' => $params['product_name'][$key],
                        'product_sku' => $params['product_sku'][$key],
                        'price' => convertStringToNumber($params['product_price'][$key]),
                        'qty' => convertStringToNumber($params['product_qty'][$key]),
                        'attribute' => json_decode($params['product_attribute'][$key], true),
                        'updated_at' => new \DateTime(),
                    ];
                    $this->shopOrderDetailService->update($orderDetailId, $orderUpdateProduct);
                } else if (empty($orderDetailId) && $key !== '#index') {
                    $orderProducts[] = [
                        'order_id' => $id,
                        'product_id' => $params['product_id'][$key],
                        'product_name' => $params['product_name'][$key],
                        'product_sku' => $params['product_sku'][$key],
                        'price' => convertStringToNumber($params['product_price'][$key]),
                        'qty' => convertStringToNumber($params['product_qty'][$key]),
                        'attribute' => $params['product_attribute'][$key],
                        'created_at' => new \DateTime(),
                        'updated_at' => new \DateTime(),
                    ];
                }
            }
            
            if (count($orderProducts) > 0) {
                $this->shopOrderDetailService->insert($orderProducts);
            }

            if (count($orderDetailIdDelete) > 0) {
                $this->shopOrderDetailService->deleteMultipleOrderDetail($orderDetailIdDelete);
            }
            
            DB::commit();
            if (true) {
                toastr()->success('Sửa đơn hàng thành công!', '', [
                    'positionClass' => 'toast-top-center',
                ]);
                return redirect()->route('admin.orders.index');
            } 
        } catch(Exception $e) {
            Log::error($e->getMessage());
            toastr()->error('Sửa đơn hàng thất bại!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->back()->withInput();
            DB::rollBack();
        }
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

    private function getShippingMethods()
    {
        return [
            [
                'value' => Constant::SHIPPING_STANDARD_VALUE,
                'label' => Constant::SHIPPING_STANDARD_LABEL 
            ],
        ];    
    }

    private function getPaymentMethods()
    {
        return [
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
    }
}
