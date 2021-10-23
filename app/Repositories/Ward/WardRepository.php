<?php

declare(strict_types=1);

namespace App\Repositories\Ward;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;

class WardRepository extends RepositoryAbstract implements WardRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Ward::class;
    }
}
