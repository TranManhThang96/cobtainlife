<?php

declare(strict_types=1);

namespace App\Repositories\ShopComment;

use App\Enums\Constant;
use App\Enums\DBConstant;
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

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;

        return $this->model
            ->with(['news' => function($query) {
                $query->select('id','alias');
            }])
            ->with(['product' => function($query) {
                $query->select('id','alias');
            }])
            ->noParent()->withCount('child')->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }
}
