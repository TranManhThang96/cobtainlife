<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopBannerService;
use App\Services\ShopCategoryService;
use App\Services\ShopNewsService;
use App\Services\ShopProductService;

class HomeController extends Controller
{
    public function __construct(
        ShopBannerService $shopBannerService,
        ShopNewsService $shopNewsService,
        ShopProductService $shopProductService,
        ShopCategoryService $shopCategoryService
    ) {
        $this->shopBannerService = $shopBannerService;
        $this->shopNewsService = $shopNewsService;
        $this->shopProductService = $shopProductService;
        $this->shopCategoryService = $shopCategoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = (object)[
            'status' => 1
        ];
        $banners = $this->shopBannerService->all($request);
        $lastNews = $this->shopNewsService->recentNews((object)['limit' => 3]);
        $newArrivalProducts = $this->shopProductService->getNewArrivalProducts();
        if ($newArrivalProducts) {
            foreach ($newArrivalProducts as &$product) {
                if (!empty($product['promotion'])) {
                    $isValid = $this->checkValidPromotion($product['promotion'], $product['price']);
                    $product['promotionValid'] = $isValid;
                }
            }
        }

        $bestSellerProducts = $this->shopProductService->getBestSellerProducts();
        if ($bestSellerProducts) {
            foreach ($bestSellerProducts as &$product) {
                if (!empty($product['promotion'])) {
                    $isValid = $this->checkValidPromotion($product['promotion'], $product['price']);
                    $product['promotionValid'] = $isValid;
                }
            }
        }

        $categories = $this->shopCategoryService->getCategoriesHomePage();

        return view('web.pages.home', compact('banners', 'lastNews', 'newArrivalProducts', 'bestSellerProducts', 'categories'));
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
