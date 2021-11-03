<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class ShopCustomer extends Model
{
    use HasFactory;

    protected $table = 'shop_customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'sex',
        'birthday',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function orders()
    {
        return $this->hasMany(\App\Models\ShopOrder::class, 'customer_id', 'id');
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
}
