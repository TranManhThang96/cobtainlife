<?php

declare(strict_types=1);

namespace App\Repositories\ShopComment;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;

class ShopCommentRepository extends RepositoryAbstract implements ShopCommentRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopComment::class;
    }
}
