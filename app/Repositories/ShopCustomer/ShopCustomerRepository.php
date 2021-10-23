<?php

declare(strict_types=1);

namespace App\Repositories\ShopCustomer;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;

class ShopCustomerRepository extends RepositoryAbstract implements ShopCustomerRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopCustomer::class;
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;

        return $this->model
            ->with('orders')
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::withCount('orders')->with('orders')->orderBy($sortBy, $orderBy)->get();
    }

    public function find($id)
    {
        return $this->model::withCount('orders')->with('orders')->find($id);
    }

}
