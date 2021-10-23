<?php

declare(strict_types=1);

namespace App\Repositories\Province;

use App\Repositories\RepositoryAbstract;

class ProvinceRepository extends RepositoryAbstract implements ProvinceRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Province::class;
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::withCount('districts')->with('districts')->orderBy($sortBy, $orderBy)->get();
    }

    public function find($id)
    {
        return $this->model::with('districts')->find($id);
    }
}
