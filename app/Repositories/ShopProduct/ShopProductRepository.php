<?php

declare(strict_types=1);

namespace App\Repositories\ShopProduct;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\DB;

class ShopProductRepository extends RepositoryAbstract implements ShopProductRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopProduct::class;
    }

    public function checkAliasExist($alias, $id)
    {
        $count = $this->model::where('alias', $alias)
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->count();
        return $count > 0;
    }

    public function getCountAliasLikeName($alias, $id)
    {
        return $this->model::where('alias', 'LIKE', $alias . '%')
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->count();
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;
        $categoryId = $request->category_id ?? '';
        $min = $request->min ?? null;
        $max = $request->max ?? null;
        $ids = $request->ids ?? null;
        $humidity = $request->humidity ?? null;
        $light = $request->light ?? null;
        $water = $request->water ?? null;

        return $this->model
            ->with('category')
            ->with('promotion')
            ->withCount('attributes')
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%")->orWhere('sku', 'like', "%$q%");
            })->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', '=', $categoryId);
            })->when($min, function ($query, $min) {
                return $query->where('price', '>=', $min);
            })
            ->when($max, function ($query, $max) {
                return $query->where('price', '<=', $max);
            })
            ->when($humidity, function ($query, $humidity) {
                return $query->where('humidity', '=', $humidity);
            })
            ->when($light, function ($query, $light) {
                return $query->where('light', '=', $light);
            })
            ->when($water, function ($query, $water) {
                return $query->where('water', '=', $water);
            })
            ->when($ids, function ($query, $ids) {
                return $query->where('id', 'IN', $ids);
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function search($request)
    {
        $q = $request->q ?? '';
        $categoryId = $request->category_id ?? '';
        $min = $request->min ?? null;
        $max = $request->max ?? null;
        $ids = $request->ids ?? null;
        $humidity = $request->humidity ?? null;
        $light = $request->light ?? null;
        $water = $request->water ?? null;

        return $this->model
            ->with('category')
            ->with('promotion')
            ->withCount('attributes')
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%")->orWhere('sku', 'like', "%$q%");
            })->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', '=', $categoryId);
            })->when($min, function ($query, $min) {
                return $query->where('price', '>=', $min);
            })
            ->when($humidity, function ($query, $humidity) {
                return $query->where('humidity', '=', $humidity);
            })
            ->when($light, function ($query, $light) {
                return $query->where('light', '=', $light);
            })
            ->when($water, function ($query, $water) {
                return $query->where('water', '=', $water);
            })
            ->when($max, function ($query, $max) {
                return $query->where('price', '<=', $max);
            })->when($ids, function ($query, $ids) {
                return $query->whereIn('id', $ids);
            })->get();
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::with('attributes')->orderBy($sortBy, $orderBy)->get();
    }

    public function getMostViewedProducts($request)
    {
        $sortBy = $request->sort_by ?? 'view';
        $orderBy = $request->order_by ?? 'DESC';
        $limit = $request->limit ?? 5;
        return $this->model::with('category')->with('promotion')->withCount('attributes')->orderBy($sortBy, $orderBy)->skip(0)->take($limit)->get();
    }

    public function getBestSellerProducts($request)
    {
        $sortBy = $request->sort_by ?? 'view';
        $orderBy = $request->order_by ?? 'DESC';
        $limit = $request->limit ?? 4;
        return $this->model::with('category')->with('promotion')->withCount('attributes')->orderBy($sortBy, $orderBy)->skip(0)->take($limit)->get();
    }

    public function getNewArrivalProducts($request)
    {
        $sortBy = $request->sort_by ?? 'updated_at';
        $orderBy = $request->order_by ?? 'DESC';
        $limit = $request->limit ?? 4;
        return $this->model::with('category')
            ->with('promotion')
            ->withCount('attributes')
            ->orderBy($sortBy, $orderBy)
            ->skip(0)->take($limit)
            ->where('new_arrival', DBConstant::PRODUCT_NEW_ARRIVAL)
            ->get();
    }

    public function find($id)
    {
        return $this->model::with('category')
            ->with('promotion')
            ->with('images')
            ->with(['attributes' => function ($query) {
                $query->select('id', 'name', 'code', 'attribute_group_id', 'product_id', 'add_price')
                    ->with(['shopAttributeGroup' => function ($q) {
                        $q->select('id', 'name');
                    }]);
            }])->with('orders')->find($id);
    }

    public function findByAlias($alias)
    {
        return $this->model::with('category')
            ->with('promotion')
            ->with('images')
            ->with('supplier')
            ->with('brand')
            ->with(['attributes' => function ($query) {
                $query->select('id', 'name', 'code', 'attribute_group_id', 'product_id', 'add_price')
                    ->with(['shopAttributeGroup' => function ($q) {
                        $q->select('id', 'name');
                    }]);
            }])->with('orders')
            ->with(['comments' => function ($query) {
                return $query->with('child:id,customer_name,customer_email,comment,comment_parent,created_at');
            }])
            ->where('alias', $alias)
            ->first();
    }

    public function relatedProducts($productId, $categoryId = null, $limit = 4)
    {
        $products =  $this->model::select('id', 'alias', 'name', 'image', 'price')
            ->with('promotion')
            ->where('id', '<>', $productId)
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', '=', $categoryId);
            })->orderBy('view', 'DESC')
            ->skip(0)->take($limit)
            ->get();
        if ($products->count() == 0) {
            $products =  $this->model::select('id', 'alias', 'name', 'image', 'price')
                ->with('promotion')
                ->where('id', '<>', $productId)->orderBy('view', 'DESC')
                ->skip(0)->take($limit)
                ->get();
        }
        return $products;
    }

    public function totalProducts()
    {
        return $this->model::count();
    }

    public function updateView($productId)
    {
        return DB::table('shop_products')->where('id', $productId)->update(
            [
                'view' => DB::raw('view + 1')
            ]
        );
    }

    public function minusQty($id, $qty)
    {
        return DB::table('shop_products')->where('id', $id)->update(
            [
                'stock' => DB::raw("stock - $qty")
            ]
        );
    }
}
