<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ShopCategoryService;
use App\Services\ShopProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    public function __construct(
        ShopCategoryService $shopCategoryService,
        ShopProductService $shopProductService
    )
    {
        $this->shopCategoryService = $shopCategoryService;
        $this->shopProductService = $shopProductService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->shopCategoryService->all();
        $products = $this->shopProductService->index($request);
        $productsMostViews = $this->shopProductService->getProductsMostViews();
        if ($products) {
            foreach($products as &$product) {
                if (!empty($product['promotion'])) {
                    $isValid = $this->checkValidPromotion($product['promotion'], $product['price']);
                    $product['promotionValid'] = $isValid;
                }
            }
        }

        if ($productsMostViews) {
            foreach($productsMostViews as &$product) {
                if (!empty($product['promotion'])) {
                    $isValid = $this->checkValidPromotion($product['promotion'], $product['price']);
                    $product['promotionValid'] = $isValid;
                }
            }
        }
        return view('web.pages.products.products', compact('products', 'productsMostViews', 'categories'));
    }


    /**
     * search
     */
    public function search(Request $request)
    {
        $categories = $this->shopCategoryService->all();
        $products = $this->shopProductService->index($request);
        if ($products) {
            foreach($products as &$product) {
                if (!empty($product['promotion'])) {
                    $isValid = $this->checkValidPromotion($product['promotion'], $product['price']);
                    $product['promotionValid'] = $isValid;
                }
            }
        }
        $view = view('web.pages.products.list', compact('products'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK, 'Tìm sản phẩm thành công');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        $product = $this->shopProductService->findByAlias($alias);
        $isPromotionValid = false;
        if (!empty($product['promotion'])) {
            $isPromotionValid = $this->checkValidPromotion($product['promotion'], $product['price']);
        }
        if (!empty($product['attributes'])) {
            $product['attributes_groups'] = collect($product['attributes'])->groupBy('attribute_group_id')->toArray();
        }
        $product['promotionValid'] = $isPromotionValid;
        $relatedProducts = $this->shopProductService->relatedProducts($product->id, $product->category_id ?? null);
        if ($relatedProducts) {
            foreach($relatedProducts as &$relatedProduct) {
                if (!empty($relatedProduct['promotion'])) {
                    $isValid = $this->checkValidPromotion($relatedProduct['promotion'], $relatedProduct['price']);
                    $relatedProduct['promotionValid'] = $isValid;
                }
            }
        }
        return view('web.pages.products.product_detail', compact('product', 'relatedProducts'));
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
}
