<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ShopOrderDetail extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'shop_order_details';

    protected $casts = [
        'attribute' => 'json',
    ];

    protected $appends = ['total_add_price'];

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_sku',
        'price',
        'qty',
        'product_attribute_id',
        'product_attribute_add_pice',
        'attribute'
    ];

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->created_by = $user->id;
           $model->updated_by = $user->id;
       });
       static::updating(function($model)
       {
           $user = Auth::guard('admin')->user();
           $model->updated_by = $user->id;
       });
    }

    public function getTotalAddPriceAttribute()
    {
        try {
            $attributes = json_decode($this->attributes['attribute'], true);
            return collect($attributes)->sum('add_price');
        } catch(Exception $e) {
            return 0;
        }
    }
}
