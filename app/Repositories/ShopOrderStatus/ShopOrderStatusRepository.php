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

    public function all()
    {

        return $this->model::all();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

}
