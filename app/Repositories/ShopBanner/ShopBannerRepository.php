<?php

declare(strict_types=1);

namespace App\Repositories\ShopBanner;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;

class ShopBannerRepository extends RepositoryAbstract implements ShopBannerRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopBanner::class;
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;

        return $this->model->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'sort';
        $orderBy = $request->order_by ?? 'ASC';
        $status = $request->status ?? null;

        return $this->model::orderBy($sortBy, $orderBy)->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->get();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

}
