<?php

declare(strict_types=1);

namespace App\Repositories\District;

use App\Repositories\RepositoryAbstract;

class DistrictRepository extends RepositoryAbstract implements DistrictRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\District::class;
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::withCount('wards')->with('wards')->orderBy($sortBy, $orderBy)->get();
    }
}
