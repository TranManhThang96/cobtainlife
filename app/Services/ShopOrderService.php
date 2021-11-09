<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopOrder\ShopOrderRepositoryInterface;
use App\Services\BaseService;
use Carbon\Carbon;

class ShopOrderService extends BaseService
{
    protected $shopOrderRepository;

    public function __construct(ShopOrderRepositoryInterface $shopOrderRepository)
    {
        $this->shopOrderRepository = $shopOrderRepository;
    }

    public function index($request)
    {
        return $this->shopOrderRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->shopOrderRepository->all($request);
    }

    public function getAll()
    {
        return $this->shopOrderRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->shopOrderRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->shopOrderRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->shopOrderRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->shopOrderRepository->delete($id);
    }

    public function totalOrders()
    {
        return $this->shopOrderRepository->totalOrders();
    }

    // thống kê 30 ngày gần đây.
    public function recentOrdersMonth()
    {
        $recentOrdersMonth = $this->shopOrderRepository->recentOrdersMonth();
        $recentOrdersMonth = array_column($recentOrdersMonth->toArray(), NULL, 'new_date');
        $data = [];
        for ($i = 30; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i)->format('d/m/Y');
            $data[] = [
                'day' => $day,
                'qty' => $recentOrdersMonth[$day]['qty'] ?? 0
            ];
        }
        return $data;
    }

    // thống kê đơn hàng 12 tháng gần nhất
    public function recentOrdersYear()
    {
        $recentOrdersYear = $this->shopOrderRepository->recentOrdersYear();
        $recentOrdersYear = array_column($recentOrdersYear->toArray(), NULL, 'new_date');
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('m/Y');
            $data[] = [
                'month' => $month,
                'qty' => $recentOrdersYear[$month]['qty'] ?? 0
            ];
        }
        return $data;
    }

    // thống kê đơn hàng từ web or other
    public function percentOrdersYear()
    {
        $data = $this->shopOrderRepository->percentOrdersYear();
        $totalOrders = 0;
        if ($data) {
            $data = $data->toArray();
            foreach ($data[0] as $key => &$item) {
                $item = intval($item);
                $totalOrders += intval($item);
            }
        }
        if ($totalOrders == 0) {
            return null;
        }
        return $data[0];
    }
}
