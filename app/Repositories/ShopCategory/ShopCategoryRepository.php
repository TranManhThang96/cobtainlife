<?php

declare(strict_types=1);

namespace App\Repositories\ShopCategory;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use App\Enums\DBConstant;

class ShopCategoryRepository extends RepositoryAbstract implements ShopCategoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopCategory::class;
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

        return $this->model
            ->withCount('products')
            ->with('parents')
            ->when($q, function ($query, $q) {
                return $query->where('title', 'like', "%$q%");
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
        return $this->model::withCount('products')->withCount('categories')->find($id);
    }

    public function getCategoriesHomePage($request)
    {
        $sortBy = $request->sort_by ?? 'sort';
        $orderBy = $request->order_by ?? 'ASC';
        $limit = $request->limit ?? 5;
        return $this->model::withCount('products')
            ->orderBy($sortBy, $orderBy)
            ->skip(0)->take($limit)
            ->where('top', DBConstant::SHOW_TOP)
            ->get();
    }
}
