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
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;

        return $this->model
            ->when($q, function ($query, $q) {
                return $query->where('title', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
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
