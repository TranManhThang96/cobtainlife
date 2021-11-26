<?php

declare(strict_types=1);

namespace App\Repositories\ShopCustomer;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\RepositoryAbstract;

class ShopCustomerRepository extends RepositoryAbstract implements ShopCustomerRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopCustomer::class;
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;

        return $this->model
            ->with('orders')
            ->with('province')
            ->with('district')
            ->with('ward')
            ->withCount('orders')
            ->when($q, function ($query, $q) {
                return $query->where(function ($qr) use ($q) {
                    $qr->where('name', 'like', "%$q%")
                        ->orWhere('phone', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%");
                });
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all($request)
    {
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        return $this->model::withCount('orders')->with('orders')->orderBy($sortBy, $orderBy)->get();
    }

    public function find($id)
    {
        return $this->model::withCount('orders')->with('orders')->find($id);
    }

    public function getCustomerByPhoneOrEmail($request)
    {
        $phone = $request->phone ?? null;
        $email = $request->email ?? null;
        return $this->model->where('phone', $phone)->orWhere('email', $email)->first();
    }

    public function totalCustomers()
    {
        return $this->model::count();
    }

    public function allMail()
    {
        return $this->model::select('email')->where('status', DBConstant::ON)->get();
    }
}
