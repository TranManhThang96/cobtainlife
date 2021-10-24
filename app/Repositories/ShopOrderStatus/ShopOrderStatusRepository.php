<?php

declare(strict_types=1);

namespace App\Repositories\ShopOrderStatus;
use App\Repositories\RepositoryAbstract;

class ShopOrderStatusRepository extends RepositoryAbstract implements ShopOrderStatusRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopOrderStatus::class;
    }

    public function index($params)
    {
        $q = $params->q ?? '';
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
