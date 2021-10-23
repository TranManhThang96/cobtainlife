<?php

declare(strict_types=1);

namespace App\Repositories\ShopPaymentStatus;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;

class ShopPaymentStatusRepository extends RepositoryAbstract implements ShopPaymentStatusRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopPaymentStatus::class;
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
