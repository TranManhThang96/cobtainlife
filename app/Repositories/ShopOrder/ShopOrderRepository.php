<?php

declare(strict_types=1);

namespace App\Repositories\ShopOrder;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;

class ShopOrderRepository extends RepositoryAbstract implements ShopOrderRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopOrder::class;
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;

        return $this->model
            ->when($q, function ($query, $q) {
                return $query->where('title', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::orderBy($sortBy, $orderBy)->get();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

}
