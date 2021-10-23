<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopOrderDetail extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'shop_order_details';

    protected $casts = [
        'attribute' => 'json',
    ];

    protected $appends = ['total_add_price', 'product_full_id'];

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

    public function getTotalAddPriceAttribute()
    {
        try {
            $attributes = json_decode($this->attributes['attribute'], true);
            return collect($attributes)->sum('add_price');
        } catch(Exception $e) {
            return 0;
        }
    }
    

    public function getProductFullIdAttribute()
    {
        try {
            $attributes = json_decode($this->attributes['attribute'], true);
            if (count($attributes) > 0) {
                return implode("-", array_keys($attributes));
            }
            return '';
        } catch(Exception $e) {
            return '';
        }
    }
}
