<?php

declare(strict_types=1);

namespace App\Repositories\ShopNews;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShopNewsRepository extends RepositoryAbstract implements ShopNewsRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopNews::class;
    }

    public function checkAliasExist($alias, $id)
    {
        $count = $this->model::where('alias', $alias)
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->count();
        return $count > 0;    
    }

    public function getCountAliasLikeName($alias, $id)
    {
        return $this->model::where('alias', 'LIKE', $alias . '%')
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->count();
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;
        $tagId = $request->tag_id ?? null;
        $tagAlias = $request->tag_alias ?? null;
        $time = $request->time ?? null;

        return $this->model
            ->with('tags:id,label,alias')
            ->when($q, function ($query, $q) {
                return $query->where('title', 'like', "%$q%");
            })->when($tagId, function ($query, $tagId) {
                return $query->whereHas('tags', function ($q) use ($tagId) {
                    $q->where('id', '=', $tagId);
                });
            })->when($tagAlias, function ($query, $tagAlias) {
                return $query->whereHas('tags', function ($q) use ($tagAlias) {
                    $q->where('alias', '=', $tagAlias);
                });
            })->when($time, function ($query, $time) {
                $time = explode('-', $time);
                return $query->whereYear('created_at', $time[0])->whereMonth('created_at', $time[1]);
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::with('tags')->orderBy($sortBy, $orderBy)->get();
    }

    public function find($id)
    {
        return $this->model::with('tags')->find($id);
    }

    public function create(array $attributes)
    {
        $newsCreated = $this->model->create($attributes);
        if (!empty($newsCreated->id) && $attributes['tags']) {
            $newsCreated->tags()->sync($attributes['tags']);
        }
        return $newsCreated;
    }

    public function update($id, $attributes)
    {
        $news = $this->model->find($id);
        if ($news) {
            $isUpdated = $news->update($attributes);
            if ($attributes['tags']) {
                $news->tags()->sync($attributes['tags']);
            }
            return $isUpdated;
        }
        return false;
    }

    public function recentNews($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $limit = $request->limit ?? 5;
        return $this->model::with('tags')->orderBy($sortBy, $orderBy)->skip(0)->take($limit)->get();
    }

    public function archives()
    {
        return $this->model::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->orderBy('created_at', 'DESC')
            ->groupBy('created_at', 'year', 'month')->get();
    }

    public function findByAlias($alias)
    {
        return $this->model::with('tags')->where('alias', $alias)->first();
    }
}
