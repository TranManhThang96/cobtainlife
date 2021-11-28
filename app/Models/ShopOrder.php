<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class ShopOrder extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'shop_orders';

    protected $fillable = [
        'customer_id',
        'subtotal',
        'shipping',
        'coupon_code',
        'discount',
        'tax',
        'total',
        'received',
        'balance',
        'payment_status',
        'shipping_status',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'customer_name',
        'email',
        'phone',
        'comment',
        'payment_method',
        'shipping_method',
        'user_agent',
        'device_type',
        'ip_address',
        'status',
        'created_by',
        'updated_by'
    ];

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->created_by = $user->id ?? null;
           $model->updated_by = $user->id ?? null;
       });
       static::updating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->updated_by = $user->id ?? null;
       });
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\ShopCustomer::class, 'customer_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'province_id', 'id');
    }


    public function district()
    {
        return $this->belongsTo(\App\Models\District::class, 'district_id', 'id');
    }

    public function ward()
    {
        return $this->belongsTo(\App\Models\Ward::class, 'ward_id', 'id');
    }

    public function paymentStatus()
    {
        return $this->belongsTo(\App\Models\ShopPaymentStatus::class, 'payment_status', 'id');
    }

    public function shippingStatus()
    {
        return $this->belongsTo(\App\Models\ShopShippingStatus::class, 'shipping_status', 'id');
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\ShopOrderDetail::class, 'order_id', 'id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(\App\Models\ShopOrderStatus::class, 'status', 'id');
    }

    public function setSubtotalAttribute($value)
    {
        $this->attributes['subtotal'] = convertStringToNumber($value);
    }

    public function setShippingAttribute($value)
    {
        $this->attributes['shipping'] = convertStringToNumber($value);
    }

    public function setTaxAttribute($value)
    {
        $this->attributes['tax'] = convertStringToNumber($value);
    }

    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = convertStringToNumber($value);
    }

    public function setReceivedAttribute($value)
    {
        $this->attributes['received'] = convertStringToNumber($value);
    }

    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = convertStringToNumber($value);
    }

    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = convertStringToNumber($value);
    }

    public function scopeOrderFrom($query, $createdAtFrom)
    {
        $startDate = convertDateToDateTime($createdAtFrom);
        return $query->where('created_at', '>=', $startDate);
    }

    public function scopeOrderTo($query, $createdAtTo)
    {
        $endDate = date('Y-m-d', strtotime(convertDateToDateTime($createdAtTo)->format('Y-m-d') . ' +1 day'));
        return $query->where('created_at', '<=', $endDate);
    }
}
