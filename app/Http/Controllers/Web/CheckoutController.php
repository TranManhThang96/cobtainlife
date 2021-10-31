<?php

namespace App\Http\Controllers\Web;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CheckoutRequest;
use App\Services\DistrictService;
use App\Services\ProvinceService;
use App\Services\ShopProductService;
use App\Services\WardService;
use App\Services\ShopOrderService;
use App\Services\ShopOrderDetailService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{

    public function __construct(
        ProvinceService $provinceService, 
        DistrictService $districtService,
        WardService $wardService,
        ShopProductService $shopProductService,
        ShopOrderService $shopOrderService,
        ShopOrderDetailService $shopOrderDetailService
    )
    {
        $this->provinceService = $provinceService;
        $this->shopProductService = $shopProductService;
        $this->districtService = $districtService;
        $this->wardService = $wardService;
        $this->shopOrderService = $shopOrderService;
        $this->shopOrderDetailService = $shopOrderDetailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = $this->provinceService->all();
        return view('web.pages.checkout', compact('provinces'));
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
    public function store(CheckoutRequest $request)
    {
        if ($request->session()->exists('cart')) {
            $request->session()->forget('cart');
        }
        //create new session
        $data = $request->all();
        $subTotal = 0;
        $tax = 0;
        $products = json_decode($request->cart, true);
        if (count($products) == 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không có sản phẩm nào!');
        }
        $ids = array_unique(array_column($products, 'id'));
        $params = (object)['ids' => $ids];
        $productsByIds = $this->shopProductService->search($params);
        if ($productsByIds) {
            foreach ($productsByIds as &$product) {
                if (!empty($product['promotion'])) {
                    $isValid = $this->checkValidPromotion($product['promotion'], $product['price']);
                    $product['promotionValid'] = $isValid;
                }
                $productsFromServer[$product->id] = $product;
            }
        }
        foreach ($products as $product) {
            $orderProducts[] = [
                'order_id' => null,
                'product_id' => $product['id'],
                'product_name' => $productsFromServer[$product['id']]->name,
                'product_sku' => $productsFromServer[$product['id']]->sku,
                'product_image' => $productsFromServer[$product['id']]->image,
                'price' => $this->getFinalPrice($productsFromServer[$product['id']], $product['attribute']),
                'qty' => $product['qty'],
                'attribute' => $product['attribute'],
            ];
            $subTotal += $this->getFinalPrice($productsFromServer[$product['id']], $product['attribute']) * $product['qty'];
        }
        $data['cart'] = $orderProducts ?? [];
        $data['subTotal'] = $subTotal;
        $data['tax'] = $tax;
        $data['totalPrice'] = $subTotal + $tax;
        $request->session()->put('cart', $data);
        return $this->apiSendSuccess(route('web.checkout-confirm'), Response::HTTP_OK, '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkoutConfirm(Request $request)
    {
        if ($request->session()->exists('cart')) {
            $province = $this->provinceService->find(session('cart')['province_id']);
            $district = $this->districtService->find(session('cart')['district_id']);
            $ward = $this->wardService->find(session('cart')['ward_id']);
            return view('web.pages.checkout_confirm', compact('province', 'district', 'ward'));
        } else {
            $emptyCart = true;
            return view('web.pages.checkout_confirm', compact('emptyCart'));
        }
    }

    public function addOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->session()->exists('cart')) {
                // insert order
                $orderData = [
                    'id' => null,
                    'customer_id' => null,
                    'subtotal' => session('cart')['subTotal'],
                    'shipping' => 0,
                    'discount' => 0,
                    'tax' => session('cart')['tax'],
                    'total' => session('cart')['totalPrice'],
                    'received' => 0,
                    'balance' => 0,
                    'province_id' => session('cart')['province_id'],
                    'district_id' => session('cart')['district_id'],
                    'ward_id' => session('cart')['ward_id'],
                    'address' => session('cart')['address'],
                    'customer_name' => session('cart')['customer_name'],
                    'email' => session('cart')['email'],
                    'phone' => session('cart')['phone'],
                    'comment' => session('cart')['comment'],
                    'payment_method' => Constant::PAYMENT_CASH_VALUE,
                    'shipping_method' => Constant::SHIPPING_STANDARD_VALUE,
                    'user_agent' => session('cart')['totalPrice'],
                    'device_type' => session('cart')['totalPrice'],
                    'ip_address' => session('cart')['totalPrice'],
                ];
                $orderInserted = $this->shopOrderService->store($orderData);
                // insert order detail
                foreach (session('cart')['cart'] as $product) {
                    $orderProducts[] = [
                        'order_id' => $orderInserted->id,
                        'product_id' => $product['product_id'],
                        'product_name' =>  $product['product_name'],
                        'product_sku' =>  $product['product_sku'],
                        'price' => $product['price'],
                        'qty' => $product['qty'],
                        'attribute' => json_encode($product['attribute']),
                        'created_at' => new \DateTime(),
                        'updated_at' => new \DateTime(),
                    ];
                }
                $this->shopOrderDetailService->insert($orderProducts);
                DB::commit();
                $request->session()->forget('cart');
                return $this->apiSendSuccess(null, Response::HTTP_OK, 'Tạo đơn hàng thành công!');
            } else {
                return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không tìm thấy đơn hàng!');
            }
        } catch (Exception $e) {
            Log::error('addOrder' . $e->getMessage());
            DB::rollBack();
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Có lỗi xảy ra!');
        }
    }


    private function checkValidPromotion($promotion, $productPrice) 
    {
        $isValid = true;
        $startDb = $promotion['start'];
        $endDb = $promotion['end'];
        $nowUTC = convertDateToDateTime(date('d/m/Y'));
        $now = $nowUTC->getTimestamp();

        if ($promotion['price_promotion'] > $productPrice) {
            return false;
        }

        if (!empty($startDb)) {
            $startDb = convertDateToDateTime($startDb, 'Y-m-d H:i:s');
            $startDbTimeStamp = $startDb->getTimestamp();
            if ($startDbTimeStamp > $now) {
                $isValid = false;
                return $isValid;
            }
        }

        if (!empty($endDb)) {
            $endDb = convertDateToDateTime($endDb, 'Y-m-d H:i:s');
            $endDbTimeStamp = $endDb->getTimestamp() + 86400;
            if ($endDbTimeStamp < $now) {
                $isValid = false;
                return $isValid;
            }
        }
        return $isValid;
    }

    private function getFinalPrice($product, $productOrderAttributes)
    {
        $finalPrice = 0;
        $addPrice = 0;
        try {
            $finalPrice = $product->promotionValid ? $product->promotion->price_promotion : $product->price;
            if ($product->attributes_count > 0) {
                foreach ($product->attributes as $attribute) {
                    $key = $attribute->product_id . '-' . $attribute->attribute_group_id . '-' . $attribute->code;
                    $productAttributes[$key] = $attribute;
                }
            }
            if ($productOrderAttributes) {
                foreach ($productOrderAttributes as $k => $productOrderAttribute) {
                    $addPrice = $addPrice + ($productAttributes[$k]['add_price'] ?? 0);
                }
            }
            return $finalPrice + $addPrice;
        } catch (Exception $e) {
            Log::error('getFinalPrice'. $e->getMessage());
            return $finalPrice + $addPrice;
        }
    }
}
