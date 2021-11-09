<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShopCustomerService;
use App\Services\ShopNewsService;
use App\Services\ShopOrderDetailService;
use App\Services\ShopOrderService;
use App\Services\ShopProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function __construct(
        ShopOrderService $shopOrderService,
        ShopProductService $shopProductService,
        ShopCustomerService $shopCustomerService,
        ShopNewsService $shopNewsService,
        ShopOrderDetailService $shopOrderDetailService
    ) {
        $this->shopOrderService = $shopOrderService;
        $this->shopProductService = $shopProductService;
        $this->shopCustomerService = $shopCustomerService;
        $this->shopNewsService = $shopNewsService;
        $this->shopOrderDetailService = $shopOrderDetailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalOrders = $this->shopOrderService->totalOrders();
        $totalProducts = $this->shopProductService->totalProducts();
        $totalCustomers = $this->shopCustomerService->totalCustomers();
        $mostViewedProducts = $this->shopProductService->getMostViewedProducts();
        $bestSellProducts = $this->shopOrderDetailService->bestSellProducts();
        $totalNews = $this->shopNewsService->totalNews();
        return view('admin.pages.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'totalNews',
            'mostViewedProducts',
            'bestSellProducts'
        ));
    }

    public function chart()
    {
        $recentOrdersMonth  = $this->shopOrderService->recentOrdersMonth();
        $recentOrdersYear  = $this->shopOrderService->recentOrdersYear();
        $percentOrdersYear = $this->shopOrderService->percentOrdersYear();
        return $this->apiSendSuccess([
            'recentOrdersMonth' => $recentOrdersMonth,
            'recentOrdersYear' => $recentOrdersYear,
            'percentOrdersYear' => $percentOrdersYear
        ], Response::HTTP_OK);
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
