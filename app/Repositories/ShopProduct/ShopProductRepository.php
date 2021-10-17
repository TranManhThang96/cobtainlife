<?php

declare(strict_types=1);

namespace App\Repositories\ShopProduct;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;

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

        return $this->model
            ->with('category')
            ->with('promotion')
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%")->orWhere('sku', 'like', "%$q%");
            })->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', '=', $categoryId);
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::withCount('products')->orderBy($sortBy, $orderBy)->get();
    }

    public function find($id)
    {
        return $this->model::with('category')->with('promotion')->with('images')->with('attributes')->with('orders')->find($id);
    }

}
