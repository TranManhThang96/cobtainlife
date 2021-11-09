<?php

declare(strict_types=1);

namespace App\Repositories\ShopOrder;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\DB;
class ShopOrderRepository extends RepositoryAbstract implements ShopOrderRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopOrder::class;
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $createdAtFrom = $request->created_at_from ?? '';
        $createdAtTo = $request->created_at_to ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;
        $status = $request->status ?? '';
        $customerId = $request->customer_id ?? null;

        return $this->model
            ->with('orderStatus')
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($createdAtFrom, function ($query, $createdAtFrom) {
                return $query->orderFrom($createdAtFrom);
            })
            ->when($createdAtTo, function ($query, $createdAtTo) {
                return $query->orderTo($createdAtTo);
            })
            ->when($q, function ($query, $q) {
                return $query->where(function ($qr) use ($q) {
                    $qr->where('customer_name', 'like', "%$q%")
                        ->orWhere('phone', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%");
                });
            })
            ->when($customerId, function ($query, $customerId) {
                return $query->where('customer_id', $customerId);
            })
            ->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::orderBy($sortBy, $orderBy)->get();
    }

    public function find($id)
    {
        return $this->model::with('province')
            ->with('district')
            ->with('ward')
            ->with('paymentStatus')
            ->with('shippingStatus')
            ->with('orderStatus', function ($query) {
                $query->select('id', 'name');
            })
            ->with('orders')
            ->find($id);
    }

    public function totalOrders()
    {
        return $this->model::count();
    }

    // thống kê đơn hàng 30 ngày gần nhất
    public function recentOrdersMonth()
    {
        return $this->model::select(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') new_date"), DB::raw("COUNT(created_at) qty"))
        ->whereRaw('created_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW()')
        ->groupBy('new_date')->get();
    }

    // thống kê đơn hàng 12 tháng gần nhất
    public function recentOrdersYear()
    {
        return $this->model::select(DB::raw("DATE_FORMAT(created_at, '%m/%Y') new_date"), DB::raw("COUNT(created_at) qty"))
        ->whereRaw('created_at BETWEEN NOW() - INTERVAL 365 DAY AND NOW()')
        ->groupBy('new_date')->get();
    }

    // thống kê đơn hàng từ web or other
    public function percentOrdersYear()
    {
        return $this->model::select(DB::raw("SUM(ISNULL(created_by)) AS web"), DB::raw("SUM(!ISNULL(created_by)) AS other"))
        ->whereRaw('created_at BETWEEN NOW() - INTERVAL 365 DAY AND NOW()')
        ->get();
    }
}
