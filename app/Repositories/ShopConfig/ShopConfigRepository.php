<?php

declare(strict_types=1);

namespace App\Repositories\ShopConfig;

use App\Repositories\RepositoryAbstract;

class ShopConfigRepository extends RepositoryAbstract implements ShopConfigRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopConfig::class;
    }

    public function updateOrCreate($request)
    {
        return $this->model::upsert($request, ['code', 'key']);
    }

    public function all()
    {
        return $this->model::all();
    }
}
