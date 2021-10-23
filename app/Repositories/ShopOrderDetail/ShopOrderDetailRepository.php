<?php

declare(strict_types=1);

namespace App\Repositories\ShopOrderDetail;
use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\DB;
class ShopOrderDetailRepository extends RepositoryAbstract implements ShopOrderDetailRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopOrderDetail::class;
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::orderBy($sortBy, $orderBy)->get();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function insert($listOrderDetail)
    {
        DB::table('shop_order_details')->insert($listOrderDetail);
    }

    public function deleteMultipleOrderDetail($orderIds)
    {
        DB::table('shop_order_details')->whereIn('id', $orderIds)->update(['deleted_at' => new \DateTime()]);
    }

}
