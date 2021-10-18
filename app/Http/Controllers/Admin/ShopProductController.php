<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShopProductRequest;
use App\Services\ShopAttributeGroupService;
use App\Services\ShopBrandService;
use Illuminate\Http\Request;
use App\Services\ShopProductService;
use App\Services\ShopCategoryService;
use App\Services\ShopLengthClassService;
use App\Services\ShopProductAttributeService;
use App\Services\ShopProductImageService;
use App\Services\ShopProductPromotionService;
use App\Services\ShopSupplierService;
use App\Services\ShopWeightClassService;
use Exception;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopProductController extends Controller
{
    protected $shopProductService;
    protected $shopCategoryService;

    public function __construct(
        ShopProductService $shopProductService,
        ShopCategoryService $shopCategoryService,
        ShopSupplierService $shopSupplierService,
        ShopBrandService $shopBrandService,
        ShopWeightClassService $shopWeightClassService,
        ShopLengthClassService $shopLengthClassService,
        ShopAttributeGroupService $shopAttributeGroupService,
        ShopProductAttributeService $shopProductAttributeService,
        ShopProductImageService $shopProductImageService,
        ShopProductPromotionService $shopProductPromotionService
    )
    {
        $this->shopProductService = $shopProductService;
        $this->shopCategoryService = $shopCategoryService;
        $this->shopSupplierService = $shopSupplierService;
        $this->shopBrandService = $shopBrandService;
        $this->shopWeightClassService = $shopWeightClassService;
        $this->shopLengthClassService = $shopLengthClassService;
        $this->shopAttributeGroupService = $shopAttributeGroupService;
        $this->shopProductAttributeService = $shopProductAttributeService;
        $this->shopProductImageService = $shopProductImageService;
        $this->shopProductPromotionService = $shopProductPromotionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->shopProductService->index($request);
        $categories = $this->shopCategoryService->index($request);
        return view('admin.pages.products.index', compact('products', 'categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $products = $this->shopProductService->index($request);
        $view = view('admin.pages.products.list', compact('products'))->render();
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
        $brands = $this->shopBrandService->all();
        $suppliers = $this->shopSupplierService->all();
        $lengthClasses = $this->shopLengthClassService->all();
        $weightClasses = $this->shopWeightClassService->all();
        $shopAttributeGroups = $this->shopAttributeGroupService->all();
        return view('admin.pages.products.add', compact('categories', 'brands', 'suppliers', 'lengthClasses', 'weightClasses', 'shopAttributeGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopProductRequest $request)
    {
        DB::beginTransaction();
        try {
            // insert product
            $params = $request->all();
            $params['name'] = ucwords(strtolower($params['name']));

            // auto create alias by name.
            $alias = Str::slug($params['name'], '-');
            $params['alias'] = $alias;

            // get the number of alias that already exist.
            $aliasExist = $this->shopProductService->checkAliasExist($alias);
            if ($aliasExist) {
                $countAlias = $this->shopProductService->getCountAliasLikeName($alias);
                $params['alias'] = $alias . '-' . ($countAlias + 1);
            }
            $product = $this->shopProductService->store($params);
            if ($product) {
                $productId = $product->id;
                // insert product promotion
                if (isset($params['price_promotion'])) {
                    $this->shopProductPromotionService->store($productId, $params['price_promotion'], $params['price_promotion_start'], $params['price_promotion_end']);
                }
                // insert attributes
                if (isset($params['attributes'])) {
                    $createdBy = auth('admin')->user()->id;
                    $this->shopProductAttributeService->insertMultiple($params['attributes'], $productId, $createdBy);
                }
                // insert image product
                if (isset($params['sub_images'])) {
                    $this->shopProductImageService->insertMultiple($params['sub_images'], $productId);
                }
            }
            DB::commit();
        } catch(Exception $e) {
            Log::error($e->getMessage());
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
        $product = $this->shopProductService->find($id);
        if ($product) {
            if (!empty($product['promotion'])) {
                $isValid = $this->checkValidPromotion($product['promotion'], $product['price']);
                $product['promotionValid'] = $isValid;
            }
            return $this->apiSendSuccess($product, Response::HTTP_OK, 'Tìm sản phẩm thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Tìm phẩm thất bại');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = [];
        $allCategories = $this->shopCategoryService->all();
        showCategories($allCategories, $categories);
        $brands = $this->shopBrandService->all();
        $suppliers = $this->shopSupplierService->all();
        $lengthClasses = $this->shopLengthClassService->all();
        $weightClasses = $this->shopWeightClassService->all();
        $shopAttributeGroups = $this->shopAttributeGroupService->all();
        $product = $this->shopProductService->find($id);
        return view('admin.pages.products.edit', compact('product', 'categories', 'brands', 'suppliers', 'lengthClasses', 'weightClasses', 'shopAttributeGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            // insert product
            $params = $request->all();
            $params['name'] = ucwords(strtolower($params['name']));

            // auto create alias by name.
            $alias = Str::slug($params['name'], '-');
            $params['alias'] = $alias;

            // get the number of alias that already exist.
            $aliasExist = $this->shopProductService->checkAliasExist($alias);
            if ($aliasExist) {
                $countAlias = $this->shopProductService->getCountAliasLikeName($alias);
                $params['alias'] = $alias . '-' . ($countAlias + 1);
            }

            if (!isset($params['status'])) {
                $params['status'] = 0;
            }

            $result = $this->shopProductService->update($id, $params);
            if ($result) {
                $productId = $id;
                // insert product promotion
                if (isset($params['price_promotion'])) {
                    $this->shopProductPromotionService->updatePromotionByProduct($productId, $params['price_promotion'], $params['price_promotion_start'], $params['price_promotion_end']);
                } else {
                    $this->shopProductPromotionService->deletePromotionByProduct($productId);
                }

                // insert attributes
                if (isset($params['attributes'])) {
                    $createdBy = auth('admin')->user()->id;
                    $this->shopProductAttributeService->updateMultiple($params['attributes'], $productId, $createdBy);
                } else {
                    $this->shopProductAttributeService->deleteAttributesByProduct($productId);
                }
                // insert image product
                if (isset($params['sub_images'])) {
                    $this->shopProductImageService->updateMultiple($params['sub_images'], $productId);
                } else {
                    $this->shopProductImageService->deleteImagesByProduct($productId);
                }
            }
            DB::commit();
            if ($result) {
                toastr()->success('Sửa sản phẩm thành công!', '', [
                    'positionClass' => 'toast-top-center',
                ]);
                return redirect()->route('admin.products.index');
            } 
        } catch(Exception $e) {
            Log::error($e->getMessage());
            toastr()->error('Sửa sản phẩm thất bại!', '', [
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
        $product = $this->shopProductService->find($id);
        if ($product->orders_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa sản phẩm vì có đơn hàng.');
        }
        $isDeleted = $this->shopProductService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Sản phẩm đã được xóa');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa sản phẩm bị lỗi');
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
