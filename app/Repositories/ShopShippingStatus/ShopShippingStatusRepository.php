<?php

declare(strict_types=1);

namespace App\Repositories\ShopShippingStatus;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;

class ShopShippingStatusRepository extends RepositoryAbstract implements ShopShippingStatusRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopShippingStatus::class;
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        return $this->model
            ->withCount('orders')
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%");
            })->get();
    }

    public function all()
    {
        return $this->model::all();
    }

    public function find($id)
    {
        return $this->model::withCount('orders')->find($id);
    }
}
