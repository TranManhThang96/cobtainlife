<?php

declare(strict_types=1);

namespace App\Repositories\ShopCustomerSubscribe;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;

class ShopCustomerSubscribeRepository extends RepositoryAbstract implements ShopCustomerSubscribeRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ShopCustomerSubscribe::class;
    }

    public function index($request)
    {
        $q = $request->q ?? '';
        $sortBy = $request->sort_by ?? 'id';
        $orderBy = $request->order_by ?? 'DESC';
        $perPage = $request->per_page ?? Constant::DEFAULT_PER_PAGE;

        return $this->model
            ->when($q, function ($query, $q) {
                return $query->where(function ($qr) use ($q) {
                    $qr->where('name', 'like', "%$q%")
                        ->orWhere('phone', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%");
                });
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function getCustomerSubscribeByPhoneOrEmail($request)
    {
        $phone = $request->phone ?? null;
        $email = $request->email ?? null;
        return $this->model->where('phone', $phone)->orWhere('email', $email)->first();
    }

    public function changeStatus($customers)
    {
        return $this->model::whereIn('id', $customers)->update(['status' => 1]);
    }

    public function allMail()
    {
        return $this->model::select('email')->get();
    }
}
