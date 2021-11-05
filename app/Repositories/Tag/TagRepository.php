<?php

declare(strict_types=1);

namespace App\Repositories\Tag;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;
use Illuminate\Support\Facades\DB;

class TagRepository extends RepositoryAbstract implements TagRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Tag::class;
    }

    public function getCountAliasLikeName($alias, $id)
    {
        return $this->model::where('alias', 'LIKE', $alias . '%')
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->count();
    }

    public function index($params)
    {
        $q = $params->q ?? '';
        $sortBy = $params->sort_by ?? 'id';
        $orderBy = $params->order_by ?? 'DESC';
        $perPage = $params->per_page ?? Constant::DEFAULT_PER_PAGE;
        return $this->model
            ->when($q, function ($query, $q) {
                return $query->where('label', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all()
    {
        return $this->model::orderBy('id', Constant::SORT_BY_DESC)->get();
    }

    public function getTagByAlias($alias, $id = null)
    {
        return $this->model::where('alias', $alias)
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->first();
    }

    public function getNewsTags()
    {
        return DB::table('shop_tags')->select(DB::raw('distinct shop_tags.id, shop_tags.label, shop_tags.alias'))
        ->join('shop_news_tag', 'shop_tags.id', '=', 'shop_news_tag.tag_id')
        ->get();
    }

}
