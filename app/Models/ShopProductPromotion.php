<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProductPromotion extends Model
{
    use HasFactory;

    protected $table = 'shop_product_promotions';

    protected $fillable = [
        'product_id',
        'price_promotion',
        'start',
        'end'
    ];
}
